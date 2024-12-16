<?php

/*
 * This file is part of the boshurik-bot-example.
 *
 * (c) Alexander Borisov <boshurik@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Help\Telegram\Command;

use Psr\Log\LoggerInterface;
use BoShurik\TelegramBotBundle\Telegram\Command\HelpCommand as BaseCommand;
use TelegramBot\Api\Types\Update;

class HelpCommand extends BaseCommand
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function isApplicable(Update $update): bool
    {
        $this->logger->info('Checking applicability of HelpCommand');
        return $update->getMessage() !== null;
    }
}
