# NCWUOJ
##   华北水利水电大学 Online Judge 系统
## 目前这个版本只是在 HUSTOJ 基础上的二次开发；
如遇到的功能性问题，依然可以使用原hustoj的解决方案
## 部署方法
1. 确保是最新版的HUSTOJ
2. 为了以防万一，将原有的oj的web目录移动至tmp下备份起来
cp -rf /home/judge/src/web /tmp
3. 通过ftp软件将解压后的web 传到 /home/judge/src/ 下面
4. cp /tmp/web/upload/* /home/judge/src/web/upload
5. 配置 vi /home/judge/src/web/include/db_info.inc
填写数据库用户名 和密码 ，要和你原来的oj一致
#### 1. 前端用layui进行重做
#### 2. 新增头像上传功能，支持gif，jpg，png，jpeg
![头像上传](https://raw.githubusercontent.com/kjctar/NCWUOJ/master/reimg/head.png)
#### 3. 优化oj社区板块
![社区](https://raw.githubusercontent.com/kjctar/NCWUOJ/master/reimg/active.png)
![留言](https://raw.githubusercontent.com/kjctar/NCWUOJ/master/reimg/active2.png)
#### 4. 对代码的提交不用跳转到状态页面，提交后会自动弹出提交结果
![提交](https://raw.githubusercontent.com/kjctar/NCWUOJ/master/reimg/sub.png)
![反馈结果](https://raw.githubusercontent.com/kjctar/NCWUOJ/master/reimg/ac.png)


## NCWUOJ查看链接：http://www.ncwu.club/new/
