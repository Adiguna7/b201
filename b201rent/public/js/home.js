'use strict'

if(document.getElementById('all').clicked == null){
    getdataitem("all");
}

function getdataitem(e){
    var xmlhttp = new XMLHttpRequest();
    var url = "http://localhost:90/home/getdataitem/" + e;      
    xmlhttp.responseType = 'json';          
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {        
        var dataitem = (this.response);        
        if(dataitem != null){
            setdataitem(dataitem);
        }            
        // console.log(dataitem[0].item_id);
        // console.log(typeof(dataitem));        
        }        
    }
    xmlhttp.open("GET", url, true);    
    xmlhttp.send();    
}

function setdataitem(dataitem){
    // console.log("pass");            
    var html = '';
    for (var i = 0; i < dataitem.length; i++) {        
        var css = "'http://localhost:90/img/items/" + dataitem[i].item_image + "'";
        // console.log(css);        
        html +=
        '<div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">'+
            '<div class="featured__item  animate__animated animate__fadeInUp">'+
                '<div id="item-image" class="featured__item__pic" style="background-image: url('+css+'); background-size: contain; background-repeat: no-repeat;">'+
                    '<ul class="featured__item__pic__hover">'+                                
                        '<li><a href="' + 'http://localhost:90/home/itemdetail/' + dataitem[i].item_id + '" id="item-info-link"><i class="fa fa-info"></i></a></li>'+                                
                    '</ul>'+
                '</div>'+
                '<div class="featured__item__text">'+
                    '<h6 id="item-name" >'+ dataitem[i].item_name +'</h6>'+                    
                '</div>'+
            '</div>'+
        '</div>';        
    }    
    document.getElementById('show-item').innerHTML = html;
}


