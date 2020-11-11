
    const grid = new gridjs.Grid({
        columns: ['Asset Tag',
                  'Model Name',
                  {
                      name: 'Vehicle Number',
                      formatter: (cell) => gridjs.html(`<span style="font-size:16px;"><strong>${cell}</strong></span>`)
                  },
                  'License Plate',
                  'VIN Number',
                  {
                      name: 'Status',
                      formatter: (cell) => gridjs.html(`<span class="${cell}"><strong>${cell}</strong></span>`)
                  },
                  {
                      name: 'Assigned To',
                      formatter: (cell) => gridjs.html(`<strong>${cell}</strong>`)
                  }
                ],
        server: {
            url: 'http://10.103.8.15/api/v1/hardware?limit=20&offset=0&sort=name&order=desc&category_id=6',
            data: (opts) => {
            return new Promise((resolve, reject) => {
                // let's implement our own HTTP client
                const xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                if (this.readyState === 4) {
                    if (this.status === 200) {
                    const resp = JSON.parse(this.response);
                    
        
                    // make sure the output conforms to StorageResponse format: 
                    // https://github.com/grid-js/gridjs/blob/master/src/storage/storage.ts#L21-L24
                    resolve({
                        data: resp.rows.map(vehicle => [vehicle.asset_tag, vehicle.model.name, vehicle.custom_fields["Vehicle Number"].value, vehicle.custom_fields["Licence Plate"].value, vehicle.custom_fields["VIN Number"].value, vehicle.status_label.status_meta, vehicle.assigned_to]),
                        total: resp.total,
                    });
                    } else {
                    reject();
                    }
                }
                };
                xhttp.open("GET", opts.url, true);
                xhttp.setRequestHeader("authorization", "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjU5ZGMwNTNhMjZkMmMzNDNmOGRlMjE2OTEzMGJmYzgyZjIzNmY3YWYzNjQ1YTAwNWE5YjIzZWMxNDQ2ZmNjOGU2ZDBjOWU1MmM0MGU1M2Y5In0.eyJhdWQiOiIxIiwianRpIjoiNTlkYzA1M2EyNmQyYzM0M2Y4ZGUyMTY5MTMwYmZjODJmMjM2ZjdhZjM2NDVhMDA1YTliMjNlYzE0NDZmY2M4ZTZkMGM5ZTUyYzQwZTUzZjkiLCJpYXQiOjE1OTgzMDQzODUsIm5iZiI6MTU5ODMwNDM4NSwiZXhwIjoxNjI5ODQwMzg1LCJzdWIiOiIxNDgiLCJzY29wZXMiOltdfQ.GCMEJRecBWYuCA_tV2DAA2h8gad5NOUltrnAfTTMIO1J0Xugo92aNSiiFYM2VrKLSOz9GCoJ0NQA5FVXzZ2UOsjNGiLUG3S5335D4EiPa8L0QAy78DOmgorcn_n4Ai_TCzC1hW_O2e4pwubw4ILq_9j67Ryxtuc2vJqxQJtKMeB4rifpD6s4vXvFPg1XSxn9egpraVoSCVwPni6OF-i4eri4OvQASlR2MiRpl7wrthsW6HuGMqlCWCieiE-PiU9OaakvpIoJkF4YpC63pWi2__OTACAHYs9Tjx0UAXrMQdxiZA27OTcl-jpbdOys7bOXOZriTfLjzzR74EmZxCTzipUX0uOg2BYGKDuFxEroJP1cLjlnrG6FdqU_1EUQ1TLvOlkbfg7SRDwrGrxXdYGgzMjEbbCxvsW08YGIivVw2f4UdH4mN5bBw6szAdzoz353M2EZVp3r6gFVdU1tvt0F7_LZDfia2OwQc4BJCKGg2yLFN0-WLTfkNc5JKDtQV2x5nECeMPoACO25TGZ28BniSvGWj6zr5KoilBoIEhjaQZshbFErLsf2Bvd3xE5DT5XsUYXLQJYn2jFfJuuzsQ7dOvNk971C0QDoR8xtieo47plyTGLlMeCOMq0Z0dchqacnK3u4OjNCr5IsdApkX69KfzT9Tyh2vnwR_PTi1MG4eb0");
                xhttp.setRequestHeader("accept", "application/json");
                xhttp.setRequestHeader("content-type", "application/json");
                xhttp.send();
            });
            }
        }
    }).render(document.getElementById("wrapper"));