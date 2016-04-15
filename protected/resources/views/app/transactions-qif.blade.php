<?php

// File header
echo "!Type:CCard\n!Account\nNMondo\nTPrepaid Debit Card\n";

// Transactions
foreach ($transactions as $transaction)
{
	$date = new DateTime($transaction->created);
	echo "D".$date->format('d/m/Y')."\n";
	echo "T".($transaction->amount / 100)."\n";
	echo "P".$transaction->description."\n";
	echo "Cc\n^\n";
}
