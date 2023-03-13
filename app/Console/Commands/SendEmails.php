<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // protected $signature = 'send:email {user} {--queue}'
    // 使用方式：php artisan send:email akali
    protected $signature = 'send:email {user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send email to user';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // 获取参数
        // $userId = $this->argument('user');
        // dd($userId);

        // 获取选项
        // $option = $this->option('queue');
        // dd($option);

        // 获取输入
        // $name = $this->ask('What is your name?');
        // 隐式输入
        // $password = $this->secret('What is the password?');
        // dd($password);

        // 请求确认
        // if ($this->confirm('Do you wish to continue?', true)) {
        //     dd('您同意了');
        // }else {
        //     dd('您拒绝了');
        // }

        // 文字颜色输出
        // $this->info('The command was successful!');
        // $this->error('Something went wrong!');
        // $this->line('Display this on the screen');
        // $this->newLine(3);

        // 表格
        // $headers = ['Name', 'Email'];
        // $users = [
        //     ['akali', '阿卡丽'],
        //     ['jinx', '金克丝'],
        //     ['ying', '樱']
        // ];
        // $this->table(
        //     $headers,
        //     $users
        // );

        // 进度条
        $users = range(1, 10);
        $bar = $this->output->createProgressBar(count($users));
        $bar->start();

        foreach ($users as $user) {
            sleep('1');
            $bar->advance();
        }

        $bar->finish();

        return Command::SUCCESS;
    }
}
