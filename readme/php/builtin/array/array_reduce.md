
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

----------------------

        /**
         * 循环处理数组每一项 经过$callback函数处理返回这一次处理的值
         * 并作为下一次的$result值继续处理
         */
        function commonUse()
        {
            $callback = function ($result, $item) {
                $result += $item;
                return $result;
            };
            $a = range(1, 10);
            $r = array_reduce($a, $callback);
            var_dump($r);
        }
        //commonUse();

-----------
        /**
         * 带初始值的循环处理数组, 数组为空,则直接返回初始值
         */
        function reduceWithInitial()
        {
            $callback = function ($result, $item) {
                $result *= $item;
                return $result;
            };

            $a = range(1, 10);
            $r = array_reduce($a, $callback, 10);
            var_dump($r);
        }
        reduceWithInitial();

[返回上一级](index.html)
