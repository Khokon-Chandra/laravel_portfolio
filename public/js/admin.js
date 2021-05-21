
var c = 1;
const baseUrl = 'http://127.0.0.1:8000/admin/';
function count()
{
    return c++;
}


$('table').on('click',function(event){
    event.preventDefault();
    let nextUrl = "http://127.0.0.1:8000/admin/visitors";
    window.history.pushState("","",nextUrl);
    
})



function setDataTable(){
    $('#dataTable').DataTable();
    $('.dataTables_length').addClass('bs-select');
}



const buttonObject = function(data_id){
    return {
        update: `<th class="th-sm"><a data-id="${data_id}" class="update" data-url="${baseUrl}update${pageName}"><i class="fas fa-edit"></i></a></th>`,
        delete: `<th class="th-sm"><a data-id="${data_id}" class="delete" data-url="${baseUrl}delete${pageName}"><i class="fas fa-trash-alt"></i></a></th>`
    }
}


const getTableRow = function(data_id,tableData){
    let str = "";
    $.each(action,function(i,item){
        str += buttonObject(data_id)[item];
    });
   
    return `<tr>${tableData} ${str}</tr>`;
}


const getServiceTableRow = function(singleRow){
    let str = "";
    $.each(attriute,function(i,attr){
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

    return getTableRow(singleRow.id,str);
}
/**
 * Update Table function appear here
 * @param {*} url 
 * @param {*} json 
 */

const fileReader = function(file){
    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = function(result){
        $("#showImage img").attr('src',reader.result);
    }
}



var updateData = function(element){

    (async (element) => {
        var url = $(element).data('url');
        var data_id = $(element).data('id');

        const { value: formValues } = await Swal.fire({
          title: 'Multiple inputs',
          html:
            '<input type="text" id="title" class="form-control mb-3" placeholder="Title">' +
            '<input type="text" id="description" class="form-control mb-3" placeholder="Description">'+
            '<input type="file" id="image" class="form-control mb-3" accept="image/*">'+
            '<div id="showImage"><img width="100%" src=""></div>',
          focusConfirm: false,
          showCancelButton: true,
          confirmButtonText: 'Upload',
          showLoaderOnConfirm: true,
          preConfirm: () => {
            let file = document.getElementById("image").files[0];
            let json = {
                id:data_id,
                title:$('#title').val(),
                description:$('#description').val(),
                image:file.name
            }
            axios.post(url,json)
            .then(function(response){
                if (!response.ok) {
                    throw new Error(response.statusText)
                  }
                  alert(response.data);
                  
            }).catch(function(error){
                Swal.showValidationMessage(
                    `Request failed: ${error}`
                )
            })

            
          }
        })
        


        })()

        $('#image').on('change',function(){
            
            fileReader(this.files[0]);
        });
}

/**
 * 
 * @param {*} url 
 * @param {*} json 
 */

// Delete ajax request
var deleteData = function(url,json){
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
            
        axios.post(url,json)
        .then(function(response){
            Swal.fire({
                icon: 'success',
                title: 'Your file has been deleted.',
                showConfirmButton: false,
                timer: 1500
              })
        }).catch(function(response){
           
        })
        }
      })
   
}






const placeAction = function(element){
    let action = element.className;
    let url = $(element).data('url');
    let data_id = $(element).data('id');

    let json = ()=>{
       return {
           delete:{id:data_id},
           update:getFormData(),
           insert:getFormData()
       }
    }

    let onActions ={
        delete:()=>{
            deleteData(url,{id:data_id});
        },
        update:()=>{
            updateData(element);
        },
        insert:()=>{
            insertData(element)
        }
    }

    onActions[action]();

}






$(document).ready(function(){

    $.each(data,function(i,item){
        $("#tbody").append(getServiceTableRow(item));
    });
    setDataTable();

    $(".update,.delete,.insert").on('click',function(){   
        placeAction(this);
    })

        

});
