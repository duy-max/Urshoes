<?php 
    $title = "So sánh";
    include "header.php";
    include "slider.php";
?>
<style>
    button.note {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        margin: 0;
        margin-right: 5px;
    }
    button.note#current {
        background-color: red;
    }
    button.note#last {
        background-color: blue;
    }
</style>
<div class="admin-content-right">
            <div class="admin-content-right-wrapper">
                <div class="nav" style="display: flex;">
                    <h1 style="margin-right: 20px;"><a href="./dashboard.php">Thống kê</a></h1>
                    <h1><a href="./dashboard-adv.php">Nâng cao</a></h1>
                </div>  
                <select id="select1">
                    <option selected value="currentweek">Tuần này</option>
                    <option value="currentmonth">Tháng này</option>
                   
                </select>
                <select id="select2">
                    <option selected value="lastweek">Tuần trước</option>
                    <option value="lastmonth">Tháng trước</option>
                </select>
                <div style="display: flex; align-items: center; margin-top: 20px;">
                    <button class="note" id="current"></button>
                    <span id="current-span" style="margin-right: 20px;"></span>
                    <button class="note" id="last"></button>
                    <span id="last-span"></span>

                </div>
                <canvas id="chart" style="width:100%;max-width:1000px; max-height: 350px; margin-top: 50px;"></canvas>
              
            </div>
        </div>
    </section>
    <div id="loading">
        <img src="./uploads/loading/Spinner1.gif" alt="">
    </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script>
    $(document).ready(function() {
      
        function load_cart_ajax(value1, value2) {
            $.ajax({
                url: "ajax-dashboard-adv.php",
                type: 'post',
                data: {
                    value1: value1,
                    value2: value2,
                },
                dataType: 'json',
                beforeSend: function() {
                    $('#loading').show(); 
                },
                success: function(result) {
                    let max_array_day = []
                    // Tim thang co ngay lon hon
                    if (result.current.length >= result.last.length) {
                        max_array_day = result.current
                    }
                    else {
                        max_array_day = result.last
                    }

                    let resultData1 = [];
                    if (result.arr1)
                       resultData1 = result.arr1;

                    let resultData2 = [];
                    if (result.arr2)
                       resultData2 = result.arr2;
                    // console.log(resultData2)
                    var arrDayChart = [];
                    var arrCountCart1 = []; // Danh sach so luong don dat hang
                    var arrCountCart2 = []; // Danh sach so luong don dat hang

                    $.each(max_array_day, function(index, item) {
                        arrDayChart.push(item[index]) // Data truc ngang
                        for (let i = 0; i < resultData1.length; i++) {
                            if (index <= result.current.length - 1) {
                                if (result.current[index][index] == resultData1[i]['DATE']) {
                                    arrCountCart1[index] = parseInt(resultData1[i]['COUNT']);
                                    break;
                                }
                                else {
                                    if (i == resultData1.length - 1) {
                                        arrCountCart1[index] = 0;
                                        break;
                                    }
                                    
                                }

                            }
                            
                        }
                        for (let i = 0; i < resultData2.length; i++) {
                            if (index <= result.last.length - 1) {
                                if (result.last[index][index] == resultData2[i]['DATE']) {
                                    arrCountCart2[index] = parseInt(resultData2[i]['COUNT']);
                                    break;
                                }
                                else {
                                    if (i == resultData2.length - 1) {
                                        arrCountCart2[index] = 0;
                                        break;
                                    }
                                    
                                }
                            }

                        }
                        
                    })
                    // console.log(arrCountCart1)
                        new Chart("chart", {
                          type: "line",
                          data: {
                            labels: arrDayChart,
                            datasets: [{ 
                                label: `${$('#select1 option:selected').text()}`,
                                data: arrCountCart1,
                                borderColor: "red",
                                fill: false
                            }, { 
                                label: `${$('#select2 option:selected').text()}`,
                                data: arrCountCart2,
                                borderColor: "blue",
                                fill: false
                            }]
                          },
                          options: {
                            legend: {display: false}
                          }
                        })
                    // $('#load_cart').html(str);
                    $('#loading').hide();
                    $('#current-span').text($('#select1 option:selected').text())
                    $('#last-span').text($('#select2 option:selected').text())

                }
            })
        }
        
        $('#select1').change(function() {
            let value1 = $('#select1').val()
            let value2 = $('#select2').val()
            if ((value1 == 'currentweek' && value2 == 'lastweek') || (value1 == 'currentmonth' && value2 == 'lastmonth')) {
                    load_cart_ajax(value1, value2);
            }
            
        })
        $('#select2').change(function() {
            let value1 = $('#select1').val()
            let value2 = $('#select2').val()
            if ((value1 == 'currentweek' && value2 == 'lastweek') || (value1 == 'currentmonth' && value2 == 'lastmonth')) {
                    load_cart_ajax(value1, value2);
                }
            })
        load_cart_ajax($('#select1').val(), $('#select2').val());
    })
    
    
</script>
</body>
</html>