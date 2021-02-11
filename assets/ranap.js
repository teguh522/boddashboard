async function chartbar2() {
    try {
        const response = await fetch(api_url);
        const {
            data
        } = await response.json();
        if (data.length > 0) {
            let kategori = [];
            let datamaja = ['data1'];
            let datakedawung = ['data2']
            let datamal = ['data3']
            let maja = data.filter((item) => {
                return item.kode_entitas == 6
            })
            let kdw = data.filter((item) => {
                return item.kode_entitas == 5
            })
            let mal = data.filter((item) => {
                return item.kode_entitas == 7
            })
            maja.slice(-10).map(item => {
                datamaja.push(item.ranap)
                kategori.push(item.tgl)
            })
            kdw.slice(-10).map(item => {
                datakedawung.push(item.ranap)
            })
            mal.slice(-10).map(item => {
                datamal.push(item.ranap)
            })
            var chart = c3.generate({

                bindto: '#chart-bar2', // id of chart wrapper
                data: {
                    columns: [
                        // each columns data
                        datamaja,
                        // datakedawung,
                        datamal
                    ],
                    type: 'area-spline', // default type of chart
                    colors: {
                        'data1': '#9932CC',
                        'data2': '#00FFFF',
                        'data3': '#FF8C00',
                    },
                    names: {
                        // name of each serie
                        'data1': 'Majalengka',
                        'data2': 'Kedawung',
                        'data3': 'Malang'
                    }
                },
                axis: {
                    x: {
                        type: 'category',
                        // name of each category
                        categories: kategori
                    },
                },
                bar: {
                    width: 16
                },
                legend: {
                    show: true, //hide legend
                },
                padding: {
                    bottom: 20,
                    top: 0
                },
            });
        }
    } catch (error) {
        console.log(error);
    }
}
chartbar2()