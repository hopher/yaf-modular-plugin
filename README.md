# Yaf Modular Plugin 

## Yaf 模块化插件


### 配置
- 将Modular.php 文件放入 application/plugins/Modular.php 目录下
- Bootstrap.php 调用_initPlugin方法

### 实现功能
- 将所有请求url /api/*/*开头，归入指定模块中
- modules 自动被充完 index/index
