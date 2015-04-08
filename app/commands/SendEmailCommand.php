<?php
/**
 *
 * Class MQEmailCommand
 */
class SendEmailCommand extends BaseCommand
{
    /**
     * @var string
     */
    protected $name = 'command:SendEmail';

    /**
     * @var string
     */
    protected $description = '每分钟运行一次，处理队列中待发送的邮件';


    /**
     * Execute the console command.
     * @return mixed
     */
    public function fire()
    {

        $result = MailService::instance()->processMailWithMQ();
        dd($result);
    }
}
