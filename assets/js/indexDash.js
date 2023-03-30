function income_statistic_chart(url){
  $('#myChart').remove(); // this is my <canvas> element
  $('#myChart_container').append('<canvas id=\"myChart\" width=\"400\"><canvas>');

  var url = url;
  var data = {'range':$('#chartrange').val(),'pic':$('#purchaser').val()};
  Ajax.call(data, url, function(resp1){
    $('#monthly').parent().html('<span class=\"counter-anim\" id=\"monthly\">'+resp1.monthly+'</span>');
    $('#weekly').parent().html('<span class=\"counter-anim\" id=\"weekly\">'+resp1.weekly+'</span>');

    var ctx44 = document.getElementById('myChart');
    var data_date = resp1.datas_date;
    var data_income = resp1.datas_income;
    var bgcolor = resp1.bgcolor;
    var myChart = new Chart(ctx44, {
        type: 'bar',
        data: {
            labels: data_date,
            datasets: [{
                label: '',
                data: data_income,
                backgroundColor: bgcolor,
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            },
            legend:{
              display: false
            }
        },
    });
  });
}

function schedules_by_result(url){
  $('#chart_6').remove(); // this is my <canvas> element
  $('#chart_6_container').append('<canvas id=\"chart_6\" height=\"265\"><canvas>');

  var url = url;
  var data = {'range':$('#chartrange').val(),'pic':$('#purchaser').val()};
  Ajax.call(data, url, function(resp1){
    var total = resp1.presentation + resp1.fails + resp1.soon_schedule + resp1.success_dealing;
    var success_dealing = resp1.success_dealing>0?resp1.success_dealing/total*100:0;
    var done = resp1.presentation>0?resp1.presentation/total*100:0;
    var fails = resp1.fails>0?resp1.fails/total*100:0;
    var soon = resp1.soon_schedule>0?resp1.soon_schedule/total*100:0;

    $('#tot_success_dealing').text(resp1.success_dealing);
    $('#tot_done').text(resp1.presentation);
    $('#tot_soon_schedule').text(resp1.soon_schedule);
    $('#tot_fails').text(resp1.fails);

    $('#success_dealing').html('<span>'+success_dealing.toPrecision(3)+'% Success Dealing</span>');
    $('#done').html('<span>'+done.toPrecision(3)+'% Presentation</span>');
    $('#soon_schedule').html('<span>'+soon.toPrecision(3)+'% Soon Schedules</span>');
    $('#fails').html('<span>'+fails.toPrecision(3)+'% Fails</span>');

    var ctx6 = document.getElementById('chart_6');
    var data6 = {
      labels: ['Success Dealing','Presentation','Soon Schedules','Fails',],
      datasets: [{
        data: [resp1.success_dealing,resp1.presentation,resp1.soon_schedule,resp1.fails],
        backgroundColor: ['#177ec1','#1c9504','#e69a2a','#d72125',],
        hoverBackgroundColor: ['#2b90d1','#7eaf74','#ebae54','#df686a',]
      }]
    };
    var pieChart  = new Chart(ctx6,{
      type: 'pie',
      data: data6,
      options: {
        animation: {
          duration:	3000
        },
        responsive: true,
        maintainAspectRatio:false,
        legend: {
          display:false
        },
        tooltip: {
          backgroundColor:'rgba(33,33,33,1)',
          cornerRadius:0,
          footerFontFamily:'Roboto'
        },
        elements: {
          arc: {
            borderWidth: 0
          }
        }
      }
    });

  });
}

function meeting_by_month(url){
  $('#chart_2').remove(); // this is my <canvas> element
  $('#chart_2_container').append('<canvas id=\"chart_2\" height=\"380\"><canvas>');

  var ctx2 = document.getElementById('chart_2').getContext('2d');
  var url = url;
  var data = {'range':$('#chartrange').val(),'pic':$('#purchaser').val()};
  Ajax.call(data, url, function(resp2){
    total_visits = resp2.total_visits;
    allsch = resp2.all;
    mwo = resp2.mwo;
    $('#total_schedule').html(allsch);
    $('#mwo').html(mwo);
    $('#total_visits').html(total_visits);
    $('.counter').counterUp({
        delay: 5,
        time:500
    });

    var data2 = {
      labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July','August','September','October','November','December'],
      datasets: [{
          label: 'Soon Schedules',
          backgroundColor: '#e69a2a',
          borderColor: '#e69a2a',
          data: [resp2.jan_notyet,resp2.feb_notyet,resp2.mar_notyet,resp2.apr_notyet,resp2.mei_notyet,resp2.jun_notyet,resp2.jul_notyet,resp2.agus_notyet,resp2.sep_notyet,
                    resp2.okt_notyet,resp2.nov_notyet,resp2.des_notyet]
        },
        {
          label: 'Fails',
          backgroundColor: '#d72125',
          borderColor: '#d72125',
          data: [resp2.jan_cancel,resp2.feb_cancel,resp2.mar_cancel,resp2.apr_cancel,resp2.mei_cancel,resp2.jun_cancel,resp2.jul_cancel,resp2.agus_cancel,resp2.okt_cancel,
                    resp2.sep_cancel,resp2.nov_cancel,resp2.des_cancel]
        },
        {
          label: 'Presentation',
          backgroundColor:'#1c9504',
          borderColor: '#1c9504',
          data: [resp2.jan,resp2.feb,resp2.mar,resp2.apr,resp2.mei,resp2.jun,resp2.jul,resp2.agus,
                    resp2.sep,resp2.okt,resp2.nov,resp2.des]
        },
        {
          label: 'Success Dealings',
          backgroundColor:'#177ec1',
          borderColor: '#177ec1',
          data: [resp2.jan_success,resp2.feb_success,resp2.mar_success,resp2.apr_success,resp2.mei_success,resp2.jun_success,resp2.jul_success,resp2.agus_success,resp2.okt_success,
                    resp2.sep_success,resp2.nov_success,resp2.des_success]
        }]
      };
      var hBar = new Chart(ctx2, {
        type:'horizontalBar',
        data:data2,

        options: {
          tooltips: {
            mode:'label'
          },
          scales: {
            yAxes: [{
              stacked: true,
              gridLines: {
                color: '#878787',
              },
              ticks: {
                fontFamily: 'Roboto',
                fontColor:'#878787'
              }
            }],
            xAxes: [{
              stacked: true,
              gridLines: {
                color: '#878787',
              },
              ticks: {
                fontFamily: 'Roboto',
                fontColor:'#878787'
              }
            }],

          },
          elements:{
            point: {
              hitRadius:40
            }
          },
          animation: {
            duration:	3000
          },
          responsive: true,
          maintainAspectRatio:false,
          legend: {
            display: false,
          },

          tooltip: {
            backgroundColor:'rgba(33,33,33,1)',
            cornerRadius:0,
            footerFontFamily:'Roboto'
          }

        }
      });

  });
}


function generate_calendar(data){
  $('#calendar').remove();
  $('#calendar_container').append('<div class=\"panel-body\" id=\"calendar\"></div>');

  var pid = $('#purchaser').val();
  $('#calendar').fullCalendar({
    buttonText:{list:'List',month: 'Month',basicWeek: 'Week',today: 'Today',},
    header:{
      right: 'prev,next, today',center:'title',left:'month,basicWeek,listDay'
    },
    dayClick:function(date, allDay, jsEvent, view) {
      var mday = ('0' + date.date()).slice(-2);
      var mmonth = ('0' + (date.month() + 1)).slice(-2);
      var myears = date.year();
      var mnow = myears+'-'+mmonth+'-'+mday;
      var today = new Date();
      var years = today.getFullYear();
      var month = ('0' + (today.getMonth() + 1)).slice(-2);
      var day = ('0' + today.getDate()).slice(-2)
      var now = years+'-'+month+'-'+day;
      today.setHours(0,0,0,0);
      var baseurl = document.getElementById('baseurl').value;

      if(pid == '' || pid == 'undefined'){
        window.location.href = baseurl + '/salesorder/schedules/view/pid//d/'+mnow;
      }else{
        window.location.href = baseurl + '/salesorder/schedules/view/pid/'+pid+'/d/'+mnow;
        //window.location.href = baseurl + '/salesorder/schedules/manage/dt/'+mnow+'/pid/'+pid;
      }

    },
    // dayRender: function (date, cell) {
    //     var today = new Date();
    //     var years = today.getFullYear();
    //     var month = ('0' + (today.getMonth() + 1)).slice(-2);
    //     var day = ('0' + today.getDate()).slice(-2)
    //     var now = years+'-'+month+'-'+day;
    //     var ex = date.format('YYYY-MM-DD');
    //     if(now == ex){
    //         cell.css('background-color', 'rgba(24, 168, 250, 0.29)');
    //     }
    //     if(ex < now){
    //         cell.css('background-color', 'rgba(250, 0, 0, 0.16)');
    //     }
    // },
   timeFormat: 'HH:mm', // uppercase H for 24-hour clock
   eventLimit:true,
   events:data,
   selectable:true,
   fixedWeekCount:false,
   firstDay:1,
   weekNumbers:false,
   lazyFetching:true,
   contentHeight:550,
   showNonCurrentDates:false,
   eventRender: function(event, element){
       var status_schedule = '';
       if($('.fc-state-active').text().toLowerCase() == 'month'){
         element.find('.fc-content .fc-time').after('</br>');
         element.find('.fc-content .fc-time').after('</br><span class=\'fc-sales\'>'+ event.salesName +'</span></br><span class=\'fc-alamat\'>'+ event.dealerName + ' | ' + event.villageName +'</span>');

         if(event.status.status == 1){
            element.find('.fc-content').before('<i class=\'zmdi zmdi-assignment fc-content-icon assign\'></i>');
         }else if (event.status.status == 2) {
           element.find('.fc-content').before('<i class=\'fa fa-users fc-content-icon checkedin\'></i>');
         }else if (event.status.status == 3) {
           element.find('.fc-content').before('<i class=\'fa fa-check-square-o fc-content-icon checkedout\'></i>');
         }else if (event.status.status == 4) {
           element.find('.fc-content').before('<i class=\'fa fa-close fc-content-icon cancel\'></i>');
         }

       }else if($('.fc-state-active').text().toLowerCase() == 'week'){
      //    element.find('.fc-content .fc-title').remove();
         element.find('.fc-content .fc-time').after('</br><span class=\'fc-sales\'>'+ event.salesName +'</span></br><span class=\'fc-alamat\'>'+ event.dealerName + ' | ' + event.villageName +'</span>');

         if(event.status.status == 1){
            element.find('.fc-content').before('<i class=\'zmdi zmdi-assignment fc-content-icon assign\'></i>');
         }else if (event.status.status == 2) {
           element.find('.fc-content').before('<i class=\'fa fa-users fc-content-icon checkedin\'></i>');
         }else if (event.status.status == 3) {
           element.find('.fc-content').before('<i class=\'fa fa-check-square-o fc-content-icon checkedout\'></i>');
         }else if (event.status.status == 4) {
           element.find('.fc-content').before('<i class=\'fa fa-close fc-content-icon cancel\'></i>');
         }

       }else if($('.fc-state-active').text().toLowerCase() == 'day'){
      //    element.find('.fc-content .fc-title').remove();
         element.find('.fc-content .fc-time').after('<span class=\'fc-sales\'>'+ event.salesName +'</span></br><span class=\'fc-alamat\'>'+ event.dealerName + ' | ' + event.villageName +'</span>');
         if(event.status.status == 1){
            element.find('.fc-content').before('<i class=\'zmdi zmdi-assignment fc-content-icon assign\'></i>');
         }else if (event.status.status == 2) {
           element.find('.fc-content').before('<i class=\'fa fa-users fc-content-icon checkedin\'></i>');
         }else if (event.status.status == 3) {
           element.find('.fc-content').before('<i class=\'fa fa-check-square-o fc-content-icon checkedout\'></i>');
         }else if (event.status.status == 4) {
           element.find('.fc-content').before('<i class=\'fa fa-close fc-content-icon cancel\'></i>');
         }

       }else if($('.fc-state-active').text().toLowerCase() == 'list' || element.find('.fc-list-item')){
         element.find('.fc-list-item-marker').addClass('fc-list-item-icons');
         if(event.status.status == 1){
            element.find('.fc-list-item-marker').html('<i class=\'zmdi zmdi-assignment\'></i>');
         }else if (event.status.status == 2) {
           element.find('.fc-list-item-marker').html('<i class=\'fa fa-users\'></i>');
         }else if (event.status.status == 3) {
           element.find('.fc-list-item-marker').html('<i class=\'fa fa-check-square-o\'></i>');
         }else if (event.status.status == 4) {
           element.find('.fc-list-item-marker').html('<i class=\'fa fa-close\'></i>');
         }

       }

       element.popover({
          title: event.title,
          content: 'Time : ' + event.waktu + ' | Status : ' + event.status.keterangan ,
          trigger: 'hover',
          placement: 'top',
          container: 'body'
        });
      }
  });
}
// $(document).ready(function() {
// // for Dashboard
//     if( $('#chart_2').length > 0 ){
//       /*
//         var ctx2 = document.getElementById("chart_2").getContext("2d");
//         $.getJSON(document.location.pathname+'/default/eventbymonth',function(data){
//             console.log(data);
//             $('#total_visits').parent().html('<span class="counter-anim" id="total_visits">'+data.total_visits+'</span>');
//             $('#total_schedule').parent().html('<span class="counter-anim" id="total_schedule">'+data.all+'</span>');
//             $('#mwo').parent().html('<span class="counter-anim" id="total_schedule">'+data.mwo+'</span>');
//             $('.counter').counterUp({
//                 delay: 10,
//                 time:1000
//             });
//             var data2 = {
//     			labels: ["January", "February", "March", "April", "May", "June", "July","August","September","October","November","December"],
//     			datasets: [
//     				{
//     					label: "Soon Schedules",
//     					backgroundColor: "#e69a2a",
//     					borderColor: "#e69a2a",
//     					data: [data.jan_notyet,data.feb_notyet,data.mar_notyet,data.apr_notyet,data.mei_notyet,data.jun_notyet,data.jul_notyet,data.agus_notyet,data.sep_notyet,
//                         data.okt_notyet,data.nov_notyet,data.des_notyet]
//     				},
//     				{
//     					label: "Fails",
//     					backgroundColor: "#d72125",
//     					borderColor: "#d72125",
//     					data: [data.jan_cancel,data.feb_cancel,data.mar_cancel,data.apr_cancel,data.mei_cancel,data.jun_cancel,data.jul_cancel,data.agus_cancel,data.okt_cancel,
//                         data.sep_cancel,data.nov_cancel,data.des_cancel]
//     				},
//     				{
//     					label: "Presentation",
//     					backgroundColor:"#1c9504",
//     					borderColor: "#1c9504",
//     					data: [data.jan,data.feb,data.mar,data.apr,data.mei,data.jun,data.jul,data.agus,data.okt,
//                         data.sep,data.nov,data.des]
//                     },
//                     {
//     					label: "Success Dealings",
//     					backgroundColor:"#177ec1",
//     					borderColor: "#177ec1",
//     					data: [data.jan_success,data.feb_success,data.mar_success,data.apr_success,data.mei_success,data.jun_success,data.jul_success,data.agus_success,data.okt_success,
//                         data.sep_success,data.nov_success,data.des_success]
//     				}
//     			]
//     		};
//
//     		var hBar = new Chart(ctx2, {
//     			type:"horizontalBar",
//     			data:data2,
//
//     			options: {
//     				tooltips: {
//     					mode:"label"
//     				},
//     				scales: {
//     					yAxes: [{
//     						stacked: true,
//     						gridLines: {
//     							color: "#878787",
//     						},
//     						ticks: {
//     							fontFamily: "Roboto",
//     							fontColor:"#878787"
//     						}
//     					}],
//     					xAxes: [{
//     						stacked: true,
//     						gridLines: {
//     							color: "#878787",
//     						},
//     						ticks: {
//     							fontFamily: "Roboto",
//     							fontColor:"#878787"
//     						}
//     					}],
//
//     				},
//     				elements:{
//     					point: {
//     						hitRadius:40
//     					}
//     				},
//     				animation: {
//     					duration:	3000
//     				},
//     				responsive: true,
//     				maintainAspectRatio:false,
//     				legend: {
//     					display: false,
//     				},
//
//     				tooltip: {
//     					backgroundColor:'rgba(33,33,33,1)',
//     					cornerRadius:0,
//     					footerFontFamily:"'Roboto'"
//     				}
//
//     			}
//     		});
//         });
//         */
// 	}
//
// //      if($('#morris_extra_line_chart').length > 0) {
// //         $.getJSON(document.location.pathname+'/'+'default/eventbymonth',function(data1){
// //             console.log(data1.getIncomeDay.length)
//
// //             var data = [];
// //             for (let index = 0; index < data1.getIncomeDay.length; index++) {
// //                 let incomeday = (index == 0 ? "hari_ke_1":"hari_ke_"+(index+1))
// //                 let crdday = (index == 0 ? "crd_hari_ke_1":"crd_hari_ke_"+(index+1))
// //                 let ordday = (index == 0 ? "ord_hari_ke_1":"ord_hari_ke_"+(index+1))
//
// //                 var updt = {
// //                     period: "Day "+(index == 0 ? "1":index+1),
// //                     Revenue: data1.getIncomeDay[index][0][incomeday],
// //                     Receiveable: data1.getCreditDay[index][0][crdday],
// //                     Total: data1.getOrderDay[index][0][ordday],
// //                 }
// //                 data.push(updt)
// //             }
//
// //             var dataNew = [];
// //             for (let index = 0; index < data1.getTotalIncomeMonth.length; index++) {
// //                 let Mincome = (index == 0 ? "inc_bulan_ke_1":"inc_bulan_ke_"+(index+1))
// //                 let Mcrd = (index == 0 ? "crd_bulan_ke_1":"crd_bulan_ke_"+(index+1))
// //                 let Mord = (index == 0 ? "ord_bulan_ke_1":"ord_bulan_ke_"+(index+1))
//
// //                 var updt = {
// //                     period: "Day "+(index == 0 ? "1":index+1),
// //                     Revenue: data1.getTotalIncomeMonth[index][0][Mincome],
// //                     Receiveable: data1.getTotalCreditMonth[index][0][Mcrd],
// //                     Total: data1.getTotalOrderMonth[index][0][Mord],
// //                 }
// //                 dataNew.push(updt)
// //             }
//
//
//
// // 		var lineChart = Morris.Line({
// //         element: 'morris_extra_line_chart',
// //         data: data ,
// //         xkey: 'period',
// //         ykeys: ['Revenue', 'Receiveable', 'Total'],
// //         labels: ['Revenue', 'Receiveable', 'Total'],
// //         pointSize: 2,
// //         fillOpacity: 0,
// // 		lineWidth:2,
// // 		pointStrokeColors:['#4798f6',  '#f0522f', '#e8ca5e'],
// // 		behaveLikeLine: true,
// // 		gridLineColor: '#878787',
// // 		hideHover: 'auto',
// // 		lineColors: ['#2f86ec', '#db3510', '#ddbc47'],
// // 		resize: true,
// // 		redraw: true,
// // 		gridTextColor:'#878787',
// // 		gridTextFamily:"Roboto",
// //         parseTime: false
// //     });
//
// //         /* Switchery Init*/
// //         var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
// //         $('#morris_switch').each(function() {
// //         new Switchery($(this)[0], $(this).data());
// //         });
//
// //         var swichMorris = function() {
// //         if($("#morris_switch").is(":checked")) {
// //             lineChart.setData(data);
// //             lineChart.redraw();
// //         } else {
// //             lineChart.setData(dataNew);
// //             lineChart.redraw();
// //         }
// //         }
//
// //         swichMorris();
// //         $(document).on('change', '#morris_switch', function () {
// //         swichMorris();
// //         });
//
//
//
// //  });
// // }
//
//
//
//
//
//
//
//
// });
