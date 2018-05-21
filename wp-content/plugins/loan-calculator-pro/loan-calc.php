<?php
setlocale(LC_MONETARY, 'en_US');
$loan = $orig_loan = (isset($_REQUEST['monthly_mortgage_monthly_mortgage_calc'])) ? $_REQUEST['monthly_mortgage_monthly_mortgage_calc'] : $_REQUEST['advanced_mortgage_calc_loan'];
$rate = (isset($_REQUEST['rate_monthly_mortgage_calc'])) ? $_REQUEST['rate_monthly_mortgage_calc'] : $_REQUEST['advanced_mortgage_calc_rate'];
$years = (isset($_REQUEST['years_monthly_mortgage_calc'])) ? $_REQUEST['years_monthly_mortgage_calc'] : $_REQUEST['advanced_mortgage_calc_years'];
$month_start_date_orig = (isset($_REQUEST['advanced_mortgage_calc_month_start_date'])) ? $_REQUEST['advanced_mortgage_calc_month_start_date'] : date('m');
$month_start_date = $month_start_date_orig;
$day_start_date = (isset($_REQUEST['advanced_mortgage_calc_day_start_date'])) ? $_REQUEST['advanced_mortgage_calc_day_start_date'] : date('d');
$year_start_date = $year_start_date_orig = (isset($_REQUEST['advanced_mortgage_calc_year_start_date'])) ? $_REQUEST['advanced_mortgage_calc_year_start_date'] : date('Y');
$months_name = array("1" => "Jan", "2" => "Feb", "3" => "Mar", "4" => "Apr", "5" => "May", "6" => "Jun", "7" => "Jul", "8" => "Aug", "9" => "Sep", "10" => "Oct", "11" => "Nov", "12" => "Dec");
$i = ($rate / 100) / 12;
$months = 12 * $years;
$z = pow((1 + $i), $months);
$mortgage = round((($loan * ($i * $z)) / ($z - 1)) * 100) / 100;
$original_mortgage = $mortgage;
$mortgage_monthly_update = $mortgage;
$k = 0;
$total_interest = 0;
$current_principal_paid = 0;
$mortgages = array();
$formatYmd = 'Y-m-d';
$formatMY = 'M-Y';
$formatm = 'm';
$startDate = $year_start_date . '-' . $month_start_date . '-' . $day_start_date;
for ($j = 0; $j < $months; $j++) {
  $mort_array = array();
  $current_interest = round(($loan * $i) * 100) / 100;
  $mortgage = $mortgage_monthly_update;
  $startDateTemp = new DateTime($startDate);  
  $month_start_date = $startDateTemp->format($formatm);
  $current_year = $startDateTemp->format('Y');
  $mortgage = round($original_mortgage * 100) / 100;
  if ($loan < $mortgage) $mortgage = $loan + $current_interest;
  $total_interest = round(($total_interest + $current_interest) * 100) / 100;
  $current_principal_paid = round(($mortgage - $current_interest) * 100) / 100;
  if (($loan - $current_principal_paid) < 0) { $loan = 0; } 
  else { $loan = round(($loan - $current_principal_paid) * 100) / 100; }
  $mort_array['month'] = $startDateTemp->format($formatMY);
  $mort_array['mortgage'] = number_format($mortgage, 2, '.', ',');
  $mort_array['current_principal_paid'] = $current_principal_paid;
  $mort_array['current_interest'] = number_format($current_interest, 2, '.', ',');
  $mort_array['total_interest'] = number_format($total_interest, 2, '.', ',');
  $mort_array['loan'] = number_format($loan, 2, '.', ',');
  $mortgages[] = $mort_array;
  $startDateTemp->modify('last day of next month');
  $startDate = $startDateTemp->format($formatYmd);
  if ($loan == 0) break;
}
$tmortages = $mortgages;
$mortgages = array_slice($mortgages, -24, 24, true);
$message_post = '';
foreach ($mortgages as $mortgage_item) {
  $message_post .= "<tr ><td>" . $mortgage_item['month'] . "</td> <td>$" . $mortgage_item['mortgage'] . "</td> <td>$" . $mortgage_item['current_principal_paid'] . "</td> <td>$" . $mortgage_item['current_interest'] . "</td> <td>$" . $mortgage_item['total_interest'] . "</td> <td class='total_loan'><strong>$" . $mortgage_item['loan'] . "</strong></td> </tr>";
}
if (isset($_POST['monthly_mortgage_calc_widget'])) {
  $i = ($rate / 100) / 12;
  $months = 12 * $years;
  $z = pow((1 + $i), $months);
  $mortgage = round((($orig_loan * ($i * $z)) / ($z - 1)) * 100) / 100;
  $response = "<table>
				<tr><td>Monthly Mortgage</td></tr>
				<tr><td>$ $mortgage</td></tr>
			</table>";
  echo $response;
} else {
  $total_rates = count($tmortages);
  $response = "<center><table class='style1' cellspacing='0'>
				<tr>
					<td>Monthly Mortgage</td>
				</tr>
				<tr>
					<td>$original_mortgage</td>
				</tr>
				</table></center>";
  echo $response;
}
?>