var express = require('express');
var router = express.Router();
var bodyParser = require('body-parser');

router.use(bodyParser.json());

/* GET users listing. */
router.post('/', function(req, res, next) {
  var name = req.body.name;
  var pccxy, pccyz, pcczx;
  console.log("recieved: " + name);
  if(name == "parag"){
    pccxy = 0.2 + (Math.random())/10;
    pccyz = -0.25 + (Math.random())/10;

    pcczx = 0.46+ (Math.random())/10;
  }
   else{
    pccxy = 0.56 + (Math.random())/10;
    pccyz = 0.60 + (Math.random())/10;

    pcczx = 0.25+ (Math.random())/10;
  }


  res.send('PCC: XY:' + pccxy + "\n" + "YZ: " + pccyz + "\n" + "ZX: " + pcczx);
  console.log("Sending PCC");
});

module.exports = router;
