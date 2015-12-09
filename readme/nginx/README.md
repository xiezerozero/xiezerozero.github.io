# 配置404页面
fastcgi_intercept_errors on;

server {

    server_name     localhost   test.com;
    listen  80;
    root    /usr/share/nginx/html;
    access_log  /ect/logs/nginx/test.com-access.log  main;

    error_page  404     /404.html
    location = 404.html {
        root html;
    }

    location ~\.php$ {  #location 定义文件类型, \.php$ 代表所有以 php 作为文件后缀的文件类型.
        
        root /www;      # 定义 php 文件存放的路径, 当前以 "/www" 作为默认存放位置.
        fastcgi_pass 127.0.0.1:9000;
        fastcgi_index index.php;        #定义 php 文件类型中的默认索引页
        
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        #fastcgi_param SCRIPT_FILENAME 定义了页面请求参数, 如客户端需要访问 /t1.php 则会自动读取 /www/t1.php文件, 如客户端访问 / 则自动读取 /www/index
        .php 文件
        include fastcgi_params;
    }

    #配置详情页路由

    location ~^(.*)$ {
        #按顺序检查文件/是否存在，返回第一个找到的文件。结尾的斜线表示为文件夹 -$uri/。
        #如果所有的文件都找不到，会进行一个内部重定向到最后一个参数。
        #务必确认只有最后一个参数可以引起一个内部重定向，之前的参数只设置内部URI的指向。 
        #最后一个参数是回退URI且必须存在，否则将会出现内部500错误。
        try_files $uri $uri/ /index.php?q=$uri&$args;   #前面$uri文件 和 $uri目录都找不到会fallback到最后一个选项,方法一个内部请求,
        #被location ~ \.php$ catch住,进入fastcgi处理程序.
    }


    location ~^/(\d+).html {
        fastcgi_pass    127.0.0.1:9000;
        fastcgi_index   index.php;
        #include        fastcgi_params;     //引入fastcgi相关变量
        #$document_root 项目根目录   root 配置对应
        fastcgi_param   SCRIPT_NAME     $document_root$fastcgi_script_name;   //开启nginx解析PHP
        fastcgi_param   REQUEST_URI     /goods/detail;
        fastcgi_param   QUERY_STRING    id=$1;
        # Nginx 默认是不支持 CGI PATH_INFO，SCRIPT_NAME 的值也不标准（糅合了 PATH_INFO）
        # 下面的两行指令，可以从 SCRIPT_NAME 中剥离出 PATH_INFO
        fastcgi_split_path_info     ^(.+\.php)(.*)$;
        fastcgi_param PATH_INFO     $fastcgi_path_info;
    }
    
    location ~ \.(gif|jpg|png|js|css)$ {    #定义资源的访问根路径(和其他配置)
        root "F:/test";
    }
    
    
}


nginx最常用的方法是利用 tcp/ip 协议连接 phpfastcgi 接口, 因此要连接php必须先启动fastcgi程序.

启动方法：

# /usr/local/bin/php-cgi-b 127.0.0.1:9000 -c /usr/local/lib/php.ini

为有效地解决php-cgi接口无法应答大量并发连接请求, 我们可以利用 spawn-fcgi或者php-fpm。



