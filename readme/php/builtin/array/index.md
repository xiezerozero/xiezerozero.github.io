

* **array_reduce**
> [array_reduce](http://php.net/manual/en/function.array-reduce.php)
> 迭代处理数组的每一项,并将处理结果作为下一项的初始值  
> mixed array_reduce(array $array, callable $callback, [mixed $initial = null])  
> Iteratively reduce the array to a single value using a callback function

        $attribs = [
             'name' => 'first_name',
             'value' => 'Edward'
         ];
    
         // Attribute string formatted for use inside HTML element
         $formatted_attribs = array_reduce(
             array_keys($attribs),                       // We pass in the array_keys instead of the array here
             function ($carry, $key) use ($attribs) {    // ... then we 'use' the actual array here
                 return $carry . ' ' . $key . '="' . htmlspecialchars( $attribs[$key] ) . '"';
             },
             ''
         );
        
         echo $formatted_attribs
     
       
* **array_map** 
> [array_map](http://php.net/manual/en/function.array-map.php)
> 将回调函数作用于数组的每一项，生成新的数组返回  
> array array_map(callable $callback, array $array1, ...array...)
    
        function cube($n)
        {
            return $n * $n * $n;
        }
        $a = [1, 2, 3, 4, 5];
        $b = array_map("cube", $a);
 

* **array_product**
> [array_product](http://php.net/manual/en/function.array-product.php)  
> 计算数组中所有制的乘积: 可以用于处理递归的情况  
        
        array_product(range(1, 100))
   
> 如果数组中的值全是bool类型, 可以用来确定这些值是否全为true
    
        array_product([$check1, $check2, $check3, $check4])
等价于  

        ($check1 && $check2 && $check3 && $check4)
        

* **array_replace** 
> [array_replace](http://php.net/manual/en/function.array-replace.php)
> array array_replace(array $array1, array $array2, ...array...)

* **array_replace_recursive**
> [array_replace_recursive](http://php.net/manual/en/function.array-replace-recursive.php)
> array array_replace_recursive(array $array1 , array $array2 [, array $... ])

* **array_search**
> [array_search](http://php.net/manual/en/function.array-search.php) 
> mixed array_search(mixed $needle, array $haystack, bool $strict = false)
> 数组中搜索给定的值,成功返回相应的键值,否则返回false(注意0, '0' 和 false区分)  
> 找到多个值的时候,只返回第一个找到的键值, 如果想返回多个, 请使用[array_keys](http://php.net/manual/en/function.array-keys.php)













