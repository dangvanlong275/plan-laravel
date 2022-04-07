<?php

namespace App\Console\Commands;

use App\Mail\Verification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class UserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create
                            {userType : Type of user example admin, user...}
                            {numberOfUser : Number of user will create default one user created}
                            {--id=*}: mang nhieu tham so
                            {user*: chi co the su dung 1 minh hoac dung tai vi tri cuoi cung cua command}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        /** Command: php artisan user:create admin 10 --id=1 --id=2 --id=3 admin1 admin2 admin3 */
        /**
         * Lay tat ca tham so truyen vao (array)
         *  [
         *    "command" => "user:create"
         *    "userType" => "admin"
         *    "numberOfUser" => "10"
         *   ]
         * */
        $arguments = $this->arguments();

        /**\
         * Lay tat ca tham so tuy chon
         */

        $options = $this->options();

        /**
         * Get option id tham so tuy chon dang array
         */

        $optionId = $this->option('id');

        /**
         * Get only tham so
         * Result: $userType = admin
        */
        $userType = $this->argument('numberOfUser');

        /**
         *Get info type string
         */
        $this->info($userType);

        /**
         * Ask: hien thi cau hoi cho nguoi dung nhap
         */

        $name = $this->ask('Ten ban la gi?');

        /**
         * Secret: Input vao dang password
         */
        $password = $this->secret('Vui long nhap mat khau?');

        /**
         * Confirm: Cau hoi tra loi yes: true, no:false
         */
        $confirm = $this->confirm('Ban co yeu thich lap trinh?');

        /**
         * Anticipate: hien thi goi y khi nhap
         */
        $values = ['Taylor', 'Dayle'];
        $nameAnticipate = $this->anticipate('What is your name?', $values);

        /**
         * Choice: hien thi cau hoi chon lua co gia tri default neu khong nhap
         */
        $default = 'Taylor'; //gia tri default phai ton tai trong values;
        $nameChoice = $this->choice('What is your name?', $values, $default);

        try {
            //code
            $params = ['Name', 'Email', 'Name', 'Email', 'Name', 'Email', 'Name', 'Email', 'Name', 'Email'];
            $bar =  $this->output->createProgressBar(count($params));
            $bar->start();
            foreach($params as $param){
                $bar->advance();
            }
            $bar->finish();
        } catch (\Exception $exception) {
            /**
             * error: hien thi message loi mau do
             * info: hien thi message mau xanh
             * line: hien thi message khong mau
             */
            $this->error($exception->getMessage());
            $this->info($exception->getMessage());
            $this->line($exception->getMessage());
        }

    }
}
