function setRequest(url, data){
        $value = data;
        $url = url;
        console.log($url);
        console.log("ee");

        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
          }
        });

        return $.ajax({
            type: 'GET',
            dataType : 'json',
            url: $url,
            data: {
                'data': $value
            },
            success: function(data)
            {
              console.log(data);
              return data;
            }
        });

}
