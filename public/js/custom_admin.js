const baseUrl = 'http://127.0.0.1:8000/admin/';

var c = 1;
function count(){
    return c++;
}

const fileReader = function(file) {
    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = function(result) {
        $("#showImage img").attr('src', reader.result);
        $("#image").removeClass('is-invalid');
    }
}


const UIController = (() => {

    /**
    Spinner html is appear here
    */
    var smSpinner = `<div class="spinner spinner-border spinner-border-sm" role="status"><span class="visually-hidden"></span></div>`;

    /**
    Toast viewer here
    */

    let tableTem = `<table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%"><thead><tr><th class="th-sm">Image</th><th class="th-sm">Title</th><th class="th-sm">Description</th><th class="th-sm">Date</th><th class="th-sm">Action</th></tr></thead><tbody id="tbody">table_content</tbody></table>`;

    const toast = (iconType,msg) => {
        const toastStatus = Swal.mixin({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        toastStatus.fire({
            icon: iconType,
            title: msg,
            allowOutsideClick: true,
        })
    }





    return {

        spinner: smSpinner,
        table: tableTem,

        setToast: (icon,msg) => {
            toast(icon,msg);
        },

    }

})();



const TableController = (() => {


    function setDataTable() {
        $('#dataTable').DataTable();
        $('.dataTables_length').addClass('bs-select');
    }


    const buttonObject = function(data_id) {
        return {
            update: `<a class="update" data-id="${data_id}" href="${baseUrl}update${pageName}"><i class="fas fa-edit"></i></a>`,
            delete: `<a class="delete" data-id="${data_id}" href="${baseUrl}delete${pageName}"><i class="fas fa-trash-alt"></i></a>`
        }
    }


    const getAction = function(data_id, tableData, action) {
        let str = "";
        $.each(action, function(i, item) {
            str += buttonObject(data_id)[item];
        });

        return `<tr>${tableData} <th class="d-flex justify-content-around">${str}</th></tr>`;
    }



    const getTableRow = function(singleRow, viewInfo) {
        let str = "";
        $.each(viewInfo.attribute, function(i, attr) {
            if (attr === 'image') {
                str += `<th data-attr="image" class="th-sm"><img class="table-img" src="${singleRow[attr]}"></th>`;
            } else {
                if (attr == 'sn') {
                    str += `<th class="th-sm">${count()}</th>`;
                } else {
                    let char = singleRow[attr];
                    let words = (char !== null) ? char.split(' ').slice(0,20).join(' ') : '';
                    str += `<th data-attr="${attr}" class="th-sm">${words}</th>`;
                }

            }
        });

        return getAction(singleRow.id, str, viewInfo.action);
    }




    const setTableBody = (allData) => {

        $("#root").empty();


        let tbody = '';
        $.each(allData.data, function(i, row) {
            tbody += getTableRow(row, allData.viewInfo);
        });


        let table = UIController.table.replace("table_content", tbody);
        $("#root").append(table);
        setDataTable();

    }

    return {
        tableBody: (json) => {
            setTableBody(json);
        }
    }

})()




const ActionController = (() => {


    function fileCatch(file, element) {

        let filedata = new FormData();

        filedata.append('id', $(element).data('id'));
        filedata.append('title', $("#title").val());
        filedata.append('description', $("#description").val());
        filedata.append('fileKey', file);

        return filedata;
    }


    const insertRow = (element) => {

        Swal.fire({
            title: 'Insert Information',
            html: `<input type="text"  id="title" class="form-control mb-3" placeholder="Title"><input type="text" id="description" class="form-control mb-3" placeholder="Description"><input type="file" id="image" class="form-control mb-3" accept="image/*"><div class="text-center" id="showImage"><img width="80%" src="http://127.0.0.1:8000/images/placeholder.png"></div>`,
            inputAttributes: {
                autocapitalize: 'off'
            },
            showCancelButton: true,
            confirmButtonText: 'Look up',
            showLoaderOnConfirm: true,
            preConfirm: (login) => {
                var data;
                var myfile = document.getElementById('image').files[0];
                var config = {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                }

                

                if (Controller.isFormValid([$("#title"), $("#description"), $("#image")])) {

                    return axios.post(element.href, fileCatch(myfile, element), config)
                        .then(response => {
                            if (response.status !== 200) {
                                throw new Error(response.statusText)
                            }
                            return response;
                        })
                        .catch(error => {
                            Swal.showValidationMessage(
                                `Request failed: ${error}`
                            )
                        })

                } else {
                    Swal.showValidationMessage('Field must not be empty!!');
                }


            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.isConfirmed) {
                UIController.setToast("success","Inserted Successfully");
                Controller.initial();
            }
        })

        $('#image').on('change', function() {

            fileReader(this.files[0]);
        });
    }


    /*
    ...................Table Update section----------------------
    */


    const updateRow = (element) => {
        var btn = $(element).closest('th');
        var tdata = $(btn).prevAll('th');
        var formData = {};

        $.each(tdata, function(i, attr) {

            if ($(attr).data('attr') == 'image') {
                formData.image = $(attr).children('img').attr('src');
            } else {
                formData[$(attr).data('attr')] = $(attr).text();
            }

        })



        Swal.fire({
            title: 'Update Information',
            html: `<input type="text" value="${formData.title}" id="title" class="form-control mb-3" placeholder="Title"><input type="text" value="${formData.description}" id="description" class="form-control mb-3" placeholder="Description"><input type="file" id="image" class="form-control mb-3" accept="image/*"><div class="text-center" id="showImage"><img width="80%" src="${formData.image}"><input type="hidden" id="img" value="${formData.image}"></div>`,
            inputAttributes: {
                autocapitalize: 'off'
            },
            showCancelButton: true,
            confirmButtonText: 'Look up',
            showLoaderOnConfirm: true,
            preConfirm: (login) => {
                var data;
                var myfile = document.getElementById('image').files[0];
                var config = {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                }

                if (typeof myfile !== 'undefined') {
                    data = fileCatch(myfile, element);
                } else {
                    data = {
                        id: $(element).data('id'),
                        title: $("#title").val(),
                        description: $("#description").val(),
                        image: $(".showImage").children('img').attr('src')
                    }
                    config = null;
                }


                console.log(Controller.isFormValid([$("#title"), $("#description"), $("#img")]))


                if (Controller.isFormValid([$("#title"), $("#description"), $("#img")])) {

                    return axios.post(element.href, data, config)
                        .then(response => {
                            if (response.status !== 200) {
                                throw new Error(response.statusText)
                            }
                            return response;
                        })
                        .catch(error => {
                            Swal.showValidationMessage(
                                `Request failed: ${error}`
                            )
                        })

                } else {
                    Swal.showValidationMessage('Field must not be empty!!');
                }


            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.isConfirmed) {
                UIController.setToast("success","Updated Successfully");
                Controller.initial();
            }
        })

        $('#image').on('change', function() {

            fileReader(this.files[0]);
        });
    }


    const deleteRow = async(element) => {
        let url = element.href;
        let data_id = $(element).data('id');
        let data = {
            id: data_id
        }
        $(element).append(UIController.spinner);
        try {
            const response = await axios.post(url, data);
            if (response.status === 200) {
                $(".spinner").remove();
                UIController.setToast('success','deleted successfully');
            }
        } catch (e) {
            UIController.setToast('error','Delate Faild');

            console.log(e);
        }

        Controller.initial();

    }


    const actions = {
        delete: (element) => {
            deleteRow(element);
        },

        update: (element) => {
            updateRow(element);
        },

        insert: (element) => {
            insertRow(element);
        }

    }




    return {
        setAction: (element) => {
            actions[element.className](element);
        }
    }

})()




const Controller = (() => {

    const init = async ()=>{

        let response = await axios.post(window.location.href);
        TableController.tableBody(response.data);

        $(".delete,.update").on('click', function(event) {
            event.preventDefault();
            ActionController.setAction(this);
        });

        $(".paginate_button").on('click', function() {
            $(".delete,.update").on('click', function(event) {
                event.preventDefault();
                ActionController.setAction(this);
            });
        })

    }


    const validateForm = (fields) => {
        var status = true;
        $.each(fields, function(i, field) {
            if (field.val() == "" || field.val() === 'undefined') {
                field.addClass('is-invalid');
                status = false;
            }
        });

        return status;
    }

    return {
        initial: () => {
            init();
        },

        isFormValid: (fields) => {
            return validateForm(fields);
        }
    }
})()






$(document).ready(function() {

    $(".insert").click(function(event) {
        event.preventDefault();
        ActionController.setAction(this);

    })

    Controller.initial();

})