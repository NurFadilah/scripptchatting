var index = function () {

    var handleFlotCharts = function () {
        var data = [],
            totalPoints = 100;

        function getRandomData() {

            if (data.length > 0)
                data = data.slice(1);

            // Do a random walk

            while (data.length < totalPoints) {

                data.push(generateNumber(2, 100));
            }

            // Zip the generated y values with the x values

            var res = [];
            for (var i = 0; i < data.length; ++i) {
                res.push([i, data[i]])
            }

            return res;
        }

        // Set up the control widget

        var updateInterval = 1000;

        var plot =
            $.plot("#placeholder", [{
                data: getRandomData()
            }], {
                series: {
                    shadowSize: 0,
                    bars: {
                        fill: .01,
                        show: true,
                        barWidth: 0.3
                    }
                },
                colors: ["#ff5722"],
                tooltip: false,
                xaxis: {
                    show: false,
                    tickColor: "#f0f1f2"
                },
                yaxis: {
                    min: 0,
                    max: 100,
                    tickSize: 25,
                    tickFormatter: function (t) {
                        return t % 25 == 0 ? t : 100
                    },
                    tickColor: "#e4e4e4"
                },
                grid: {
                    hoverable: !0,
                    clickable: !0,
                    borderWidth: 0,
                    tickColor: "#f0f1f2"
                },
                shadowSize: 0
            });


        function update() {
            plot.setData([getRandomData()]);
            plot.draw();
            setTimeout(update, updateInterval);
        }

        update();
    }

    function generateNumber(min, max) {
        min = typeof min !== 'undefined' ? min : 1;
        max = typeof max !== 'undefined' ? max : 100;

        return Math.floor((Math.random() * max) + min);
    }

    var handleAAPL = function () {


        setInterval(function () {
            $('.info-aapl span').each(function (index, elem) {
                $(elem).animate({
                    height: generateNumber(1, 40)
                });
            });

        }, 3000);


    }
    var handleChartSmall = function () {
        var comma_separator_number_step = $.animateNumber.numberStepFactories.separator(',');
        $('#earning-number').animateNumber({
            number: 50645,
            numberStep: comma_separator_number_step
        }, 5000);
        $('#new-customer-number').animateNumber({
            number: 3420,
            numberStep: comma_separator_number_step
        }, 5000);

        //BEGIN CHART EARNING
        var d2 = [["Jan", 200], ["Feb", 80], ["Mar", 199], ["Apr", 147], ["May", 293], ["Jun", 192]];
        $.plot("#earning-chart", [{
            data: d2,
            color: "#ffce54"
        }], {
            series: {
                lines: {
                    show: !0,
                    fill: .01
                },
                points: {
                    show: !0,
                    radius: 4
                }
            },
            grid: {
                borderColor: "#f0f1f2",
                borderWidth: 1,
                hoverable: !0
            },
            tooltip: !0,
            tooltipOpts: {
                content: "%x : %y",
                defaultTheme: false
            },
            xaxis: {
                tickColor: "#f0f1f2",
                mode: "categories"
            },
            yaxis: {
                tickColor: "#f0f1f2"
            },
            shadowSize: 0
        });
        //END CHART EARNING


        //BEGIN CHART NEW CUSTOMER
        var d7 = [["Jan", 93], ["Feb", 78], ["Mar", 47], ["Apr", 35], ["May", 48], ["Jun", 26]];
        $.plot("#new-customer-chart", [{
            data: d7,
            color: "#2196f3"
        }], {
            series: {
                bars: {
                    align: "center",
                    lineWidth: 0,
                    show: !0,
                    barWidth: .6,
                    fill: .9
                }
            },
            grid: {
                borderColor: "#f0f1f2",
                borderWidth: 1,
                hoverable: !0
            },
            tooltip: !0,
            tooltipOpts: {
                content: "%x : %y",
                defaultTheme: false
            },
            xaxis: {
                tickColor: "#f0f1f2",
                mode: "categories"
            },
            yaxis: {
                tickColor: "#f0f1f2"
            },
            shadowSize: 0
        });
        //END CHART NEW CUSTOMER


    }
    var handleMarkers = function () {
        var cityAreaData = [
                700.70,
                210.69,
                920.17,
                150.35,
                630.22
            ],
            key = [
                'Monaco',
                'Saint Kitts and Nevis',
                'Grenada',
                'Bahrain',
                'São Tomé and Príncipe'
            ]

        var cityAreaDataKey = [];
        for (var i = 0, lengt = cityAreaData.length; i < lengt; i++) {
            cityAreaDataKey[i] = {
                label: key[i],
                data: cityAreaData[i]
            }
        }
    }
    var handleSparkline = function () {
        $(".sparkline1").sparkline([5, 6, 7, 2, 0, 4, 2, 4, 5, 6, 7, 2, 3, 4, 2, 4, 2, 1, 3, 6, 3, 5, 2, 7, 4, 2, 1, 3, 6, 3, 5, 2, 7, 4, 6], {
            type: 'bar',
            height: '80px',
            barWidth: 8,
            zeroAxis: false,
            barColor: '#07bf29'
        });
        // Bar charts using inline values
        $('.sparkbar.green').sparkline('html', {type: 'bar', barColor: '#55F072', height: '20'});
        $('.sparkbar.default').sparkline('html', {type: 'bar', barColor: '#ccc', height: '20'});
    }

    var handleNumber = function () {
        $('#number-blogs').animateNumber({number: 1240}, 4000)
        $('#number-following').animateNumber({number: 60}, 3500)
        $('#number-follower').animateNumber({number: 117}, 3500)
        $('#number-humidity').animateNumber({number: 88}, 3500)
    }

    var handleSkycons = function () {
        //BEGIN SKYCON
        var icons = new Skycons({"color": "white"});

        icons.set("icon1", Skycons.SNOW);
        icons.set("icon2", Skycons.RAIN);
        icons.set("icon3", Skycons.PARTLY_CLOUDY_DAY);
        icons.set("icon4", Skycons.PARTLY_CLOUDY_NIGHT);
        icons.set("icon5", Skycons.WIND);
        icons.set("icon6", Skycons.RAIN);
        icons.set("icon7", Skycons.SLEET);
        icons.set("wind", Skycons.WIND);
        icons.set("fog", Skycons.FOG);

        icons.play();
        //END SKYCON
    }
    return {
        init: function () {
            handleMarkers();
            handleFlotCharts();
            handleAAPL();
            handleChartSmall();
            handleSparkline();
            handleSkycons();
            handleNumber();
        }
    }

}(jQuery);



