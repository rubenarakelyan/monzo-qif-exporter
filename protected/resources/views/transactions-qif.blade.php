<?php

// File header
echo "!Type:CCard\n";

// Transactions
foreach ($transactions as $transaction)
{
	// Date
	$date = new DateTime($transaction->created);
	echo "D".$date->format('d M Y')."\n";
	echo "T".$transaction->amount."\n";
	echo "M".$transaction->description."\n";
	echo "Cc\n^\n";
}
