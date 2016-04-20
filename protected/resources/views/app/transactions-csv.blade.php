<?php

// Transactions
foreach ($transactions as $transaction)
{
	$date = (new \DateTime($transaction->created))->setTimezone(new \DateTimeZone('Europe/London'));
	echo $date->format('d/m/Y').','.($transaction->amount / 100).',"'.$transaction->description.'"'."\n";
}
