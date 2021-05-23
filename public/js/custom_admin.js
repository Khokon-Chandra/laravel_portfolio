
const baseUrl = 'http://127.0.0.1:8000/admin/';




const UIElements = ()=>{


    /**
    Spinner html is appear here
    */



    var spinner = `<div class="spinner-border spinner-border-sm" role="status"><span class="visually-hidden"></span></div>`;

    /**
    Toast viewer here
    */
    const toast = (msg)=>{
        const Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
          }
        })

        Toast.fire({
          icon: 'success',
          title: msg
        })
    }


}



const TableController = ()=>{


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
                str += `<th class="th-sm"><img class="table-img" src="${singleRow[attr]}"></th>`;
            }else{
                if(attr == 'sn'){
                    str += `<th class="th-sm">${count()}</th>`;
                }else{
                    str += `<th class="th-sm">${singleRow[attr]}</th>`;
                }
                
            }
        });

        return getAction(singleRow.id,str,viewInfo.action);
    }




    const setTableBody = (allData)=>{
        $("#tbody").empty();
        $.each(allData.data,function(i,row){
            $("#tbody").append(getTableRow(row,allData.viewInfo));
        })
        setDataTable();
    }

    return {
        tableBody:setTableBody(allData)
    }

}




const ActionController = ()=>{


    const deleteRow = (url,json)=>{
        toast('deleted successfully');
        init();
    }


    const placeAction = (action)=>{
        let url = action.href;
        let actionName = action.className;
        let data_id = action.data_id;

        const actions = {
            delete:(url,data_id)=>{
                deleteRow(url,{id:data_id});
            },
            update:(url,data_id)=>{
                alert("updated");
            }
        }

        actions[actionName](url,data_id);
    }


}




const Controller = ()=>{
    
    async function init(){

        let response = await axios.post(window.location.href);
        TableController.tableBody(response.data);

        $(".delete,.update,.insert").on('click', function(event) {
           event.preventDefault();
           $(this).append(spinner);
           placeAction(this);
        });

    }

    
}







$(document).ready(function(){
    
    Controller();

})
