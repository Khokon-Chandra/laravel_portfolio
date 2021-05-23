
const baseUrl = 'http://127.0.0.1:8000/admin/';

const fileReader = function(file){
    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = function(result){
        $("#showImage img").attr('src',reader.result);
    }
}


const UIController = (()=>{

    /**
    Spinner html is appear here
    */
    var smSpinner = `<div class="spinner spinner-border spinner-border-sm" role="status"><span class="visually-hidden"></span></div>`;

    /**
    Toast viewer here
    */

    let tableTem = `<table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%"><thead><tr><th class="th-sm">Image</th><th class="th-sm">Title</th><th class="th-sm">Description</th><th class="th-sm">Date</th><th class="th-sm">Action</th></tr></thead><tbody id="tbody">table_content</tbody></table>`;
    
    const toast = (msg)=>{
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
          icon: 'success',
          title: msg,
          allowOutsideClick:true,
        })
    }



    return {

        spinner:smSpinner,
        table:tableTem,

        setToast:(msg)=>{
            toast(msg);
        },

    }

})();



const TableController = (()=>{


    function setDataTable(){
        $('#dataTable').DataTable();
        $('.dataTables_length').addClass('bs-select');
    }


    const buttonObject = function(data_id){
        return {
            update: `<a class="update" data-id="${data_id}" href="${baseUrl}update${pageName}"><i class="fas fa-edit"></i></a>`,
            delete: `<a class="delete" data-id="${data_id}" href="${baseUrl}delete${pageName}"><i class="fas fa-trash-alt"></i></a>`
        }
    }


    const getAction = function(data_id,tableData,action){
        let str = "";
        $.each(action,function(i,item){
            str += buttonObject(data_id)[item];
        });
       
        return `<tr>${tableData} <th class="d-flex justify-content-around">${str}</th></tr>`;
    }



    const getTableRow = function(singleRow,viewInfo){
        let str = "";
        $.each(viewInfo.attribute,function(i,attr){
            if(attr === 'image'){
                str += `<th data-attr="image" class="th-sm"><img class="table-img" src="${singleRow[attr]}"></th>`;
            }else{
                if(attr == 'sn'){
                    str += `<th class="th-sm">${count()}</th>`;
                }else{
                    str += `<th data-attr="${attr}" class="th-sm">${singleRow[attr]}</th>`;
                }
                
            }
        });

        return getAction(singleRow.id,str,viewInfo.action);
    }




    const setTableBody = (allData)=>{
       
        $("#root").empty();


        let tbody = '';
        $.each(allData.data,function(i,row){
           tbody += getTableRow(row,allData.viewInfo);
        });


        let table = UIController.table.replace("table_content",tbody);
        $("#root").append(table);
        setDataTable();

    }

    return {
        tableBody:(json)=>{
            setTableBody(json);
        }
    }

})()




const ActionController = (()=>{


    function fileCatch(file,element){
         
            
            let filedata = new FormData();
           
            filedata.append('id',$(element).data('id'));
            filedata.append('title',$("#title").val());
            filedata.append('description',$("#description").val());
            filedata.append('fileKey',file);

            return filedata;
    }



    const updateRow = (element)=>{
        var btn = $(element).closest('th');
        var tdata = $(btn).prevAll('th');
        var title,description,image;
        $.each(tdata,function(i,attr){
           
            if($(attr).data('attr') == 'title'){
                title  = $(attr).text();
            }
            else if ($(attr).data('attr') == 'description') {
                description  = $(attr).text();
            }
            else if ($(attr).data('attr') == 'image') {
                image  = $(attr).children('img').attr('src');
            }
        })

                    
        
        Swal.fire({
          title: 'Submit your Github username',
          html:`<input type="text" value="${title}" id="title" class="form-control mb-3" placeholder="Title"><input type="text" value="${description}" id="description" class="form-control mb-3" placeholder="Description"><input type="file" id="image" class="form-control mb-3" accept="image/*"><div class="text-center" id="showImage"><img width="50%" src="${image}"></div>`,
          inputAttributes: {
            autocapitalize: 'off'
          },
          showCancelButton: true,
          confirmButtonText: 'Look up',
          showLoaderOnConfirm: true,
          preConfirm: async (login) => {
            let myfile = document.getElementById('image').files[0];
            let config = {headers:{'content-type':'multipart/form-data'}}
            
            if(typeof myfile !== 'undefined'){
               var data = fileCatch(myfile,element);
               return await axios.post(element.href,data,config);
            }else{
                var data = {
                    id:$(element).data('id'),
                    title:$("#title").val(),
                    description:$("#description").val(),
                    image: $(".showImage").children('img').attr('src')
                }
                 return await axios.post(element.href,data);
            }



            
          },
          allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            console.log(result.value.data);
          if (result.isConfirmed) {
            UIController.setToast("Updated Successfully");
          }
        })

        $('#image').on('change',function(){
            
            fileReader(this.files[0]);
        });
    }


    const deleteRow = async (element)=>{
        let url = element.href;
        let data_id = $(element).data('id');
        let data = {id:data_id}
        $(element ).append(UIController.spinner);
        try {
            const response = await axios.post(url,data);
            if(response.status === 200){
                $(".spinner").remove();
                UIController.setToast('deleted successfully');
                Controller.initial;
            }
        } catch(e) {
            
            console.log(e);
        }

        Controller.initial();

    }


    const placeAction = (actionElement )=>{

        const actions = {
            delete:(element)=>{
                deleteRow(element);
            },
            update:(element)=>{
                updateRow(element);
            }
        }

        
        actions[actionElement .className](actionElement );
    }

    return {
        setAction:(element)=>{
            placeAction(element);
        }
    }

})()




const Controller = (()=>{

    async function init(){
        
        let response = await axios.post(window.location.href);
        TableController.tableBody(response.data);

        $(".delete,.update,.insert").on('click', function(event) { 
           event.preventDefault();
           ActionController.setAction(this);
        });

        $(".paginate_button ").on('click',function(){
            $(".delete,.update,.insert").on('click', function(event) {     
               event.preventDefault();
               ActionController.setAction(this);
            });
        })

    }

    return {
        initial : ()=>{
            init();
        }
    }
})()







$(document).ready(function(){
    
   Controller.initial();

})
