# 搭建一个见到的web服务器
    基于http协议,Go语言提供了一个完善的`net\http`包,通过该包可以很方便的搭建起一个可运行的web服务程序.  
    同时能处理web的路由,静态文件,模板以及cookie的数据
    
    ## 利用http包搭建一个简单的web服务器
        
        package main
        import (
        	"net/http"
        	"log"
        	"fmt"
        )
        
        func main() {
        	http.HandleFunc("/", func (w http.ResponseWriter, r *http.Request) {
        	r.ParseForm()
        	fmt.Println(r.Form)
        	fmt.Println(r.URL.Scheme)
        	fmt.Println(r.URL.Path)
        	fmt.Println(r.FormValue("param1"))
        	fmt.Fprint(w, "hello world")
        	})
        	err := http.ListenAndServe(":9090", nil)
        	if err != nil {
        		log.Fatal("error:", err)
        	}
        }
    
`go build`之后,运行exe文件,在浏览器中输入localhost:9090可看到浏览器输出`hello world`,控制台也会打印出相应的信息

Go就是不需要nginx,apache这些服务器,因为它直接坚挺TCP端口了,干了nginx的事情,匿名函数func跟php中的控制层(controller)类似.  
Go通过几行代码就可以搭建起一个web服务,而且这个web服务内部具有支持高并发的特性.(每一个请求都是利用goroutines单开一个够程来完成,互不干扰)