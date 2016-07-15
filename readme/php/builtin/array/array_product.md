
* **array_product**
> [array_product](http://php.net/manual/en/function.array-product.php)  
> 计算数组中所有制的乘积: 可以用于处理递归的情况  
        
        array_product(range(1, 100))
   
> 如果数组中的值全是bool类型, 可以用来确定这些值是否全为true
    
        array_product([$check1, $check2, $check3, $check4])
等价于  

        ($check1 && $check2 && $check3 && $check4)
        
[返回上一级](index.html) 