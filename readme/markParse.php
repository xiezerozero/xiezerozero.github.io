<?php
/**
 * @author xiezerozero
 * xiezerozero@qq.com
 */



include 'Parsedown.php';
$parser = new Parsedown();
//源目录
$sourceDir = 'E:/mine/tech/xiezerozero.github.io/readme';
//$sourceDir = 'f:/test/xiezerozero.github.io/readme';
//目标目录
$targetDir = 'E:/mine/tech/xiezerozero.github.io';
//$targetDir = 'f:/test/xiezerozero.github.io';

$iterator = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($sourceDir, FilesystemIterator::SKIP_DOTS),
    RecursiveIteratorIterator::SELF_FIRST   // lists leaves and parents,parents coming first
);
//模板文件内容  替换{{title}}和 {{content}}
$templateContent = file_get_contents(__DIR__ . '/template.html');

/** @var SplFileInfo $file */
foreach ($iterator as $file) {
    //过滤脚本文件
    if ($file->getExtension() == 'php' || $file->getExtension() == 'html') {
        continue;
    }
    if ($file->isDir()) {
        // 目标目录名称替换源目录名称   源目录可能是多层级的目录结构
        $dir = str_replace($sourceDir, $targetDir, $file->getPathname());
        if (!file_exists($dir)) {
            mkdir($dir);
        }
    } else {
        // 替换源目录到目标目录,确定生成的html目标文件名称
        $targetFile = str_replace($sourceDir, $targetDir, $file->getPath()) . '/' . $file->getBasename('.md') . '.html';
        $source = file_get_contents($file->getPathname());
        // 获取markdown转html后的内容
        $parsedContent = $parser->text($source);
        $content = str_replace(
            '{{content}}',
            $parsedContent,
            str_replace('{{title}}', $file->getBasename('.md'), $templateContent)
        );
        file_put_contents($targetFile, $content);
    }
}
