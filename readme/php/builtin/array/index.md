

* **array_reduce**
> [array_reduce](http://php.net/manual/en/function.array-reduce.php)
> 迭代处理数组的每一项,并将处理结果作为下一项的初始值
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
         

    
    
