
* **array_splice**
> [array_splice](http://php.net/manual/en/function.array-splice.php) 
> 把数组中的一部分去掉并用其他值取代(可以去掉0个在指定的位置插入N个,也可以只去掉)
> array array_splice ( array &$input , int $offset [, int $length = 0 [, mixed $replacement ]] )
> 返回一个包含被移除单元的数组   


        /**
         * 对数组在指定位置移除指定个数单元, 并插入指定数据
         */
           function insertArray()
           {
               $a = range(1, 10);
               $replacement = ['a', 'b', 'c'];
               array_splice($a, 3, 0, $replacement);
               var_dump($a);
           }
           
-----------
       /**
        * 插入的数据在数组中全是数字键值,如果数组中没有数字键值, 则从0开始,否则以当前位置递增
        */
          function removeAndInsert()
          {
              $a = range(1, 10);
              $index = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j'];
              $a = array_combine($index, $a);
              $replacement = ['a', 'b', 'c'];
              // 插入的数据丢失了键值
              $replacement = array_combine($replacement, $replacement);
              array_splice($a, 3, 2, $replacement);
              var_dump($a);
          }
          removeAndInsert();
       
----------
       function removeAllFromIndexAndReplace()
       {
           $a = range(1, 10);
           $replacement = ['a', 'b', 'c'];
           $replacement = array_combine($replacement, $replacement);
           //使用count($a)代表移动键值为3后面的所有值并插入
           //$replacement丢失了自己的键值
           array_splice($a, 3, count($a), $replacement);
           var_dump($a);
       }
       //removeAllFromIndexAndReplace();
       
[返回上一级](index.html) 