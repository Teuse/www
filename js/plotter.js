
//------------------------------------------------------------------------------
//--- Helper Functions
//------------------------------------------------------------------------------

function prepareArray(data) {
  var out = [];
  for (var i = 0; i < data.length; i++) {
    out.push([ i , data[i] ]);
  }
  return out;
}


//------------------------------------------------------------------------------
//--- Main Plot Functions
//------------------------------------------------------------------------------

function createSpeedPlot(jsonData)
{
  var graphData = [
      { data : prepareArray(jsonData['download']), label :'download' },
      { data : prepareArray(jsonData['upload']),   label :'upload' }
    ];

  function mouseTrackFormatter(obj) {
    var date  = jsonData['date'][Math.floor(obj.x)];
    var value = jsonData[obj.series.label][Math.floor(obj.x)];
    return date + ': ' + obj.series.label + ' = ' + value + ' MBit/s';
  }

  function xTickFormater(x, obj) {
    return jsonData['date'][Math.floor(x)];
  }

  var properties = {
    yaxis  : { max: 51, min: 0 },
    legend : { position: 'nw', backgroundColor: '#F6F4F0', backgroundOpacity: 0 },
    xaxis  : { noTicks: 5, tickFormatter: xTickFormater },
    mouse  : { track: true, position: 'se', trackFormatter: mouseTrackFormatter,
    	         margin: 3, color: '#ff3f19', trackDecimals: 1, sensibility: 8, radius: 3 }
  };

  //--- Draw Graph
  var container = document.getElementById('speedGraph');
  var graph     = Flotr.draw(container, graphData , properties);
}

//------------------------------------------------------------------------------


function createTempPlot(jsonData)
{
  var graphData = [
      { data : prepareArray(jsonData['cpu']),   label :'cpu' },
      { data : prepareArray(jsonData['raspi']), label :'raspi' },
      { data : prepareArray(jsonData['room']),  label :'room' }
    ];


  function mouseTrackFormatter(obj) {
    var date   = jsonData['date'][Math.floor(obj.x)];
    var time   = jsonData['time'][Math.floor(obj.x)];
    var value  = jsonData[obj.series.label][Math.floor(obj.x)];
    return date + "   " + time.substring(0,5)+ ':  ' + obj.series.label + ' = ' + value + ' °C';
  }

  function xTickFormater(x, obj) {
    return jsonData['date'][Math.floor(x)];
  }

  var properties = {
    yaxis : { max: 55, min : 10 },
    legend: { position: 'nw', backgroundColor: '#F6F4F0', backgroundOpacity: 0 },
    xaxis : {	noTicks: 5, tickFormatter: xTickFormater },
    mouse : { track: true, position: 'se', trackFormatter: mouseTrackFormatter,
    	        margin: 3, color: '#ff3f19', trackDecimals: 1, sensibility: 8, radius: 3 }
  };

  //--- Draw Graph
  var container = document.getElementById('tempGraph');
  var graph     = Flotr.draw(container, graphData , properties);
}

//------------------------------------------------------------------------------
//--- SPEED
//------------------------------------------------------------------------------
document.getElementById("speedGraphDebug").innerHTML = 'Speed Started.';

var req_speed;
if (window.XMLHttpRequest) { req_speed = new XMLHttpRequest(); }
else                       { req_speed = new ActiveXObject("Microsoft.XMLHTTP"); }
req_speed.onreadystatechange=function() {
    if (req_speed.readyState==4 && req_speed.status==200)
    {
      var data = JSON.parse(req_speed.responseText);
      createSpeedPlot( data );
      document.getElementById("speedGraphDebug").innerHTML = '';
    }
    else if (req_temp.status != 200) {
      document.getElementById("speedGraphDebug").innerHTML = 'Failed to load Speed Data';
    }
}
req_speed.open("GET","../php/internet_speed.php",true);
req_speed.send();

//------------------------------------------------------------------------------
//--- TEMPERATURE
//------------------------------------------------------------------------------

var req_temp;
if (window.XMLHttpRequest) { req_temp=new XMLHttpRequest(); }
else                       { req_temp=new ActiveXObject("Microsoft.XMLHTTP"); }
req_temp.onreadystatechange=function() {
    if (req_temp.readyState==4 && req_temp.status==200)
    {
      var data = JSON.parse(req_temp.responseText);
      createTempPlot( data );
      document.getElementById("tempGraphDebug").innerHTML = '';
    }
    else if (req_temp.status != 200) {
      document.getElementById("tempGraphDebug").innerHTML = 'Failed to load Temperature Data';
    }
}
req_temp.open("GET","../php/temperatures.php",true);
req_temp.send();
