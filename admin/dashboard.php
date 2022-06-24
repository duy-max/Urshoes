<?php 
    $title = "Thống kê";
    include "header.php";
    include "slider.php";
?>

<div class="admin-content-right">
            <div class="admin-content-right-wrapper">
                <div class="nav" style="display: flex;">
                    <h1 style="margin-right: 20px;"><a href="./dashboard.php">Thống kê</a></h1>
                    <h1><a href="./dashboard-adv.php">Nâng cao</a></h1>
                </div>  
                <select id="select">
                    <option selected value="currentweek">Tuần này</option>
                    <option value="lastweek">Tuần trước</option>
                    <option value="currentmonth">Tháng này</option>
                </select>
                <div id="chart">

                </div>

                <table>
                    <tr>
                        <th>Ngày đặt hàng</th>
                        <th>Số lượng</th>
                    </tr>
                    <tbody id="load_cart">

                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <div id="loading">
        <img src="./uploads/loading/Spinner1.gif" alt="">
    </div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
    $(document).ready(function() {
        google.charts.load('current',{packages:['corechart']});
        function drawChart(arr) {
            // Set Data
            var data = google.visualization.arrayToDataTable(arr);
            // Set Options
            var options = {
                title: 'Biểu đồ',
                hAxis: {title: 'Ngày'},
                vAxis: {title: 'Số đơn'},
                legend: 'none'
            };
            // Draw
            var chart = new google.visualization.LineChart(document.getElementById('chart'));
                chart.draw(data, options);
        }
        function load_cart_ajax(value) {
            
            
            $.ajax({
                url: "ajax-dashboard.php",
                type: 'post',
                data: {
                    value: value,
                },
                dataType: 'json',
                beforeSend: function() {
                    $('#loading').show(); 
                },
                success: function(result) {
                    $('#loading').hide();
                    // console.log(result)
                    if (result.length > 0) {
                        let str = ``;
                        let arr = [['Ngay', 'Count']];
                        $.each(result, function(index, item) {
                            arr.push([item['DATE'], parseInt(item['COUNT'])])
                            
                            str += `
                                <tr>
                                    <td>${item['DATE']}</td>
                                    <td>${item['COUNT']}</td>
                                </tr>
                            `;
                        })
                        google.charts.setOnLoadCallback(function() {
                                drawChart(arr)
                            });
                        $('#load_cart').html(str);
                    }
                    
                }
            })
        }
        $('#select').change(function() {
            let value = $('#select').val()
            load_cart_ajax(value);
        })
        load_cart_ajax($('#select').val());
    })
    
    
</script>
</body>
</html>