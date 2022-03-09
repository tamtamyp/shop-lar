const Custom = {
    btnShowDetailClick : function(){
        //this is Element (isnot Custom)
        const url = $(this).data('url');
        console.log(url);
        return $.ajax({
            url: url,
            type: 'GET',
            dataType: 'JSON',
            success: Custom.btnShowDetailClickCallback,
        });
    },
    btnShowDetailClickCallback : function(response){
        Custom.replaceDataUserDetail(response.items);
        console.log('a');
        $("#ds_product").empty();
        let products = response.product;
        for(let index in products){
            let product = products[index];
            let $temp   = Custom.getTemplateDetail();
            $temp.find('td').each(function(){
                let key = $(this).attr('data-key') || "";
                if(key == 'price'){
                    product[key] += '&nbsp;<span>₫</span>';
                }
                $(this).html(product[key]);
            });
            $("#ds_product").append($temp);
        }
    },
    replaceDataUserDetail: function(datas){
        $('[data-model-type="modelDetailCart"]').find("[data-key]").each(function(){
            let dataKey = this.getAttribute("data-key") || "";
            if(typeof datas[dataKey] == 'undefined'){
                return;
            }
            this.innerText = datas[dataKey];
        })
    },
    getTemplateDetail : function(clone = true){
        let $tr          = $("<tr />").addClass("even pointer");
        let $productName = $("<td />").attr("data-key", "product_name");
        let $quantity    = $("<td />").attr("data-key", "quantity");
        let $price       = $("<td />").attr("data-key", "price");

        $tr.append($productName).append($quantity).append($price);
        
        return clone ? $tr.clone() : $tr;
    }
}