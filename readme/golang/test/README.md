# golang单元测试

Go语言中自带有一个轻量级的测试框架testing和自带的go test命令来实现单元测试和性能测试，  
testing框架和其他语言中的测试框架类似，你可以基于这个框架写针对相应函数的测试用例，  
也可以基于该框架写相应的压力测试用例，那么接下来让我们一一来看一下怎么写。


## 如何编写测试用例
由于go test命令只能在一个相应的目录下执行所有文件，所以我们接下来新建一个项目目录gotest,这样我们所有的代码和测试代码都在这个目录下。

接下来我们在该目录下面创建两个文件：math.go和math_test.go

1. math.go:这个文件里面我们是创建了一个包，里面有一个函数实现了除法运算:
    
        package gotest
        
        import (
            "errors"
        )
        
        func Division(a, b float64) (float64, erro) {
            if b == 0 {
                return 0, error.NewError("除数不能为0")
            }
            return a/b, nil
        }
    
2. math_test.go:这是我们的针对math.go的单元测试文件,要遵循以下原则:
    
    
    a.文件名必须是`_test.go`结尾的，这样在执行`go test`的时候才会执行到相应的代码  
    b.你必须import `testing`这个包  
    c.所有的测试用例函数必须是`Test`开头  
    d.测试用例会按照源代码中写的顺序依次执行  
    e.测试函数`TestXxx()`的参数是`testing.T`，我们可以使用该类型来记录错误或者是测试状态  
    f.测试格式：`func TestXxx (t *testing.T)`,`Xxx`部分可以为任意的字母数字的组合，但是首字母不能是小写字母[a-z]，例如`Testintdiv`是错误的函数名。  
    g.函数中通过调用`testing.T`的`Error`, `Errorf`, `FailNow`, `Fatal`, `FatalIf`方法，说明测试不通过，调用Log方法用来记录测试的信息。  
     
    下面是单元测试的代码
    
        package gotest
        
        import (
            "testing"
        )
        
        func Test_Division_1(t *testing.T) {
            if i, e := Division(6, 2); i != 3 || e != nil { //try a unit test on function
                t.Error("除法函数测试没通过") // 如果不是如预期的那么就报错
            } else {
                t.Log("第一个测试通过了") //记录一些你期望记录的信息
            }
        }
        
        func Test_Division_2(t *testing.T) {
            if i, e := Division(6, 0); e != nil {
                    t.Error(e.Error())
            } else {
                t.Log("通过测试")
            }
        }

    我们在test目录下运行go test,就会执行单元测试,显示如下信息
	    
        --- FAIL: Test_Division_2 (0.00 seconds)
            math_test.go:16: 除数不能为0
        FAIL
        exit status 1
        FAIL    math  0.013s
            
    默认情况下执行 go test是不会显示测试通过的信息,我们需要带上参数`go test -v`,这样就会显示详细信息;  
    执行某个测试方法使用如下命名`go test -v -run "Test_Devision_1"`
    
## 如果编写压力测试
压力测试用来检测函数(方法）的性能，和编写单元功能测试的方法类似,此处不再赘述，但需要注意以下几点：

* 压力测试用例必须遵循如下格式，其中XXX可以是任意字母数字的组合，但是首字母不能是小写字母

        func BenchmarkXXX() {...}
* `go test`默认不会执行压力测试函数,需要带上参数`-test.bench`,  
    语法:`-test.bench="test_name_regex"`,例如:`go test -test.bench=".*"`表示执行全部压力测试
* 在压力测试用例中,请记得在循环体内使用`testing.B.N`,以使测试可以正常的运行
* 文件名也必须以`_test.go`结尾  

下面我们新建一个压力测试文件webbench_test.go,代码如下:
        
        package gotest
        
        import (
            "testing"
        )
        
        func Benchmark_Division(b *testing.B) {
            for i := 0; i < b.N; i++ { //use b.N for looping 
                Division(4, 5)
            }
        }
        
        func Benchmark_TimeConsumingFunction(b *testing.B) {
            b.StopTimer() //调用该函数停止压力测试的时间计数
        
            //做一些初始化的工作,例如读取文件数据,数据库连接之类的,
            //这样这些时间不影响我们测试函数本身的性能
        
            b.StartTimer() //重新开始时间
            for i := 0; i < b.N; i++ {
                Division(4, 5)
            }
        }
我们执行命令`go test -file webbench_test.go -test.bench=".*"`，可以看到如下结果：
        
        PASS
        Benchmark_Division  500000000            7.76 ns/op
        Benchmark_TimeConsumingFunction 500000000            7.80 ns/op
        ok      math  9.364s  

上面的结果显示我们没有执行任何`TestXXX`的单元测试函数，显示的结果只执行了压力测试函数，第一条显示了  
`Benchmark_Division`执行了500000000次，每次的执行平均时间是7.76纳秒，第二条显示  
了`Benchmark_TimeConsumingFunction`执行了500000000，每次的平均执行时间是7.80纳秒。最后一条显示总共的执行时间。

## 小结
通过上面对单元测试和压力测试的学习，我们可以看到`testing`包很轻量，编写单元测试和压力测试用例非常简单，配合内置  
的`go test`命令就可以非常方便的进行测试，这样在我们每次修改完代码,执行一下go test就可以简单的完成回归测试了  

## links
* 本文内容参考[链接](https://github.com/astaxie/build-web-application-with-golang/blob/master/zh/11.3.md)

