<?php

/*
 * This file is part of the boshurik-bot-example.
 *
 * (c) Alexander Borisov <boshurik@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Hello\Telegram\Command;

use Psr\Log\LoggerInterface;
use BoShurik\TelegramBotBundle\Telegram\Command\AbstractCommand;
use BoShurik\TelegramBotBundle\Telegram\Command\PublicCommandInterface;
use TelegramBot\Api\BotApi;
use TelegramBot\Api\Types\Update;

class HelloCommand extends AbstractCommand implements PublicCommandInterface
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function getName(): string
    {
        return '/hello';
    }

    public function getDescription(): string
    {
        return 'Example command';
    }

    public function execute(BotApi $api, Update $update): void
    {
        $this->logger->info('Executing HelloCommand');
        preg_match(self::REGEXP, $update->getMessage()->getText(), $matches);
        $who = !empty($matches[3]) ? $matches[3] : 'World';

        $text = sprintf('Hello *%s*', $who);
        $api->sendMessage($update->getMessage()->getChat()->getId(), $text, 'markdown');
    }
}
