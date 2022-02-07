<?php
$url = 'https://app.sports.qq.com/m/oly/medalsRank?seasonID=2022';
$data = file_get_contents($url);
$data = json_decode($data, true);
$country_num = count($data['data']['list']); //获取国家数量
echo '2022奥运奖牌榜';
echo '<table>';
echo '<tr>
<td></td>
<td></td>
<td><img class="logo" src="https://mat1.gtimg.com/qqcdn/dongaomzb/img/dongjing_jinse.png" width=20px height=20px></td>
<td><img class="logo" src="https://mat1.gtimg.com/qqcdn/dongaomzb/img/dongjing_yinse.png" width=20px height=20px></td>
<td><img class="logo" src="https://mat1.gtimg.com/qqcdn/dongaomzb/img/dongiing_tongse.png" width=20px height=20px></td>
<td>总</td>
</tr>';
for ($i = 0; $i < 10; $i++) {
    $nocName = $data['data']['list'][$i]['nocName'];
    $noclogo = $data['data']['list'][$i]['nocLogo'];
    $gold_num = $data['data']['list'][$i]['gold'];
    $silver_num = $data['data']['list'][$i]['silver'];
    $bronze_num = $data['data']['list'][$i]['bronze'];
    $bronze_total = $data['data']['list'][$i]['total'];
    echo '<tr>
               <td><span class="item-num item-num-' . $i . '">' . ($i + 1) . '</span></td>
               <td><img class="logo" src="' . $noclogo . '" alt="" width="20">' . $nocName . '</td>
               <td>' . $gold_num . '</td>
               <td>' . $silver_num . '</td>
               <td>' . $bronze_num . '</td>
               <td>' . $bronze_total . '</td>
              </tr>';
}
echo '</table>';
?>