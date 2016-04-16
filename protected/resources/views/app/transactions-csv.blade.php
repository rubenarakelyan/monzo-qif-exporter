<?php

// Transactions
foreach ($transactions as $transaction)
{
	$date = new DateTime($transaction->created);
	echo $date->format('d/m/Y').','.($transaction->amount / 100).',"'.$transaction->description.'"'."\n";
}
