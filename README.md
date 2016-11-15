## 使用方法

配置目录中的config.php文件
master配置项是主
slave配置项是从
本脚本主要是slave同步master的表结构，并不对master做改变。

配置完之后你可以使用命令模式或web模式访问index.php。同步会自动完成，建议使用命令模式

```
php index.php
```

> 本脚本需要PHP5.5及以上版本，需要安装mysqli扩展
