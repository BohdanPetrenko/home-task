<?php

namespace App\Jobs;

use App\PaymentCard;
use App\Repositories\PaymentCardRepository;
use App\TransactionLog;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\DatabaseManager;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TransferMoneyJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private array $data;

    private bool $status = false;

    /**
     * Create a new job instance.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @param PaymentCardRepository $repository
     * @param DatabaseManager $manager
     * @param TransactionLog $logger
     *
     * @return void
     */
    public function handle(PaymentCardRepository $repository, DatabaseManager $manager, TransactionLog $logger)
    {
        $sender = $repository->findByNumber($this->data['sender']);
        $recipient = $repository->findByNumber($this->data['recipient']);
        $transferAmount = (float)$this->data['transfer_amount'];

        try {
            $manager->transaction(function () use ($sender, $recipient, $transferAmount) {
                $sender->balance->update(['balance' => $sender->balance->balance - $transferAmount]);
                $recipient->balance->update(['balance' => $recipient->balance->balance + $transferAmount]);
            });
            $this->status = true;
        } catch (\Throwable $e) {
            $this->status = false;
        }

        $this->addLog($sender, $recipient, $transferAmount, $logger);
    }

    private function addLog(
        PaymentCard $sender,
        PaymentCard $recipient,
        float $transferAmount,
        TransactionLog $logger
    ):
    void {
        $logger->create([
            'sender' => $sender->card_number,
            'recipient' => $recipient->card_number,
            'transfer_amount' => $transferAmount,
            'status' => $this->status,
        ]);
    }
}
