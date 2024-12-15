<div>
    <!DOCTYPE html>
    <html>
    
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    
        <script>
            // Ignore this in your implementation
            window.isMbscDemo = true;
        </script>
    
    
        <!-- Mobiscroll JS and CSS Includes -->
        <link rel="stylesheet" href="{{asset('select2/css/mobiscroll.javascript.min.css')}}">
        <script src="{{asset('select2/js/mobiscroll.javascript.min.js')}}"></script>
    
        <style type="text/css">
                body {
            margin: 0;
            padding: 0;
        }
    
        button {
            display: inline-block;
            margin: 5px 5px 0 0;
            padding: 10px 30px;
            outline: 0;
            border: 0;
            cursor: pointer;
            background: #5185a8;
            color: #fff;
            text-decoration: none;
            font-family: arial, verdana, sans-serif;
            font-size: 14px;
            font-weight: 100;
        }
    
        input {
            width: 100%;
            margin: 0 0 5px 0;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 0;
            font-family: arial, verdana, sans-serif;
            font-size: 14px;
            box-sizing: border-box;
            -webkit-appearance: none;
        }
    
        .mbsc-page {
            padding: 1em;
        }
    
        </style>
    
    </head>
    
    <body>
    
        <div mbsc-page class="demo-multiple-select">
            <div style="height:100%">
                    <label>
            Multi-select
            <input mbsc-input id="demo-multiple-select-input" placeholder="Please select..." data-dropdown="true" data-input-style="outline" data-label-style="stacked" data-tags="true" />
        </label>
        <select id="demo-multiple-select" multiple>
            <option value="1">Books</option>
            <option value="2">Movies, Music & Games</option>
            <option value="3">Electronics & Computers</option>
            <option value="4">Home, Garden & Tools</option>
            <option value="5">Health & Beauty</option>
            <option value="6">Toys, Kids & Baby</option>
            <option value="7">Clothing & Jewelry</option>
            <option value="8">Sports & Outdoors</option>
        </select>
          
            </div>
        </div>
    
        <script>
            
                mobiscroll.setOptions({
          locale: mobiscroll.localeEn,                                          // Specify language like: locale: mobiscroll.localePl or omit setting to use default
          theme: 'ios',                                                         // Specify theme like: theme: 'ios' or omit setting to use default
            themeVariant: 'light'                                               // More info about themeVariant: https://mobiscroll.com/docs/javascript/select/api#opt-themeVariant
        });
        
        mobiscroll.select('#demo-multiple-select', {
          inputElement: document.getElementById('demo-multiple-select-input'),  // More info about inputElement: https://mobiscroll.com/docs/javascript/select/api#opt-inputElement
        });
          
        </script>
    
    </body>
    
    </html>
</div>