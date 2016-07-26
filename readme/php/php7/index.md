###. Throwable
    Error
        ArithmeticError
        AssertionError
        DivisionByZeroError
        ParseError
        TypeError
    Exception
        ....
        
        
###. declare(strict_types=1)  //开启严格模式,不再做类型转换,类型不匹配抛出异常(返回值亦是如此)

    declare(strict_types=1)

    function add(int $a, int $b) : int 
    {
        return $a + $b;
    }


###. <=> (太空船运算符) 当$a小于、等于或大于$b时它分别返回-1、0或1(可用作排序)


###. ?? null合并运算符

      $userName = $_GET['user'] ?? 'nobody';   
      // equals
      $userName = isset($_GET['user']) ? $_GET['user'] : 'nobody';
      // 多个null合并运算符
      $username = $_GET['user'] ?? $_POST['user'] ?? 'nobody';
  
###. generator(生成器)
    
       function count_to_ten()     //generator implements Iterator
       {
           yield 1;
           yield from [2, 3];
           return 4;
       }
       $a = count_to_ten();
       var_dump($a);    //object(generator)[1]
       
       $a->send($message);
       $a->getReturn();
   
### 不定参数
       function sum(...$numbers)    //定义不定个数参数(类型最好统一,不然很难处理)
       {
           return array_sum($numbers);  //$numbers是所有传递的参数的数组
       }
       echo sum(1,2,3,4,5); //$numbers=[1,2,3,4,5];
       
       
       function test(array ...$arrays) : array  //限制每个参数都是array格式,将所有的参数组装到$arrays数组中,申明返回值array类型
       {
           return array_map(function ($v) : int {  //匿名函数申明返回值是int(declare严格模式不会隐式转换)
                return array_sum($v);
           }, $arrays);
       }
       var_dump(test([1, 2.2, 3.5], [4, 5, 6], [7, 8, 9])); //$arrays=[[1, 2.2, 3.5], [4, 5, 6], [7, 8, 9]];
   
   
    