@servers(['web' => ['root@64.227.129.152']])
 
@task('deploy', ['on' => 'web'])
    cd /var/www/sankranti_india/
    git pull origin master
@endtask