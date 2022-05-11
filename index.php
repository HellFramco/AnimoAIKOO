<audio autoplay loop>
    <source src="words.mp3" type="audio/mp3">
        Tu navegador no soporta audio HTML5.
</audio>
<link href='https://fonts.googleapis.com/css?family=Josefin+Sans:100,300' rel='stylesheet' type='text/css'>
<div class="cover super-centered-container">
  <canvas id="can">Get a browser</canvas>
  <div class="overlay-static">    
    <div class="inline-blocks">
      <h2 class="twenty-one block">AIKO </h2>
      <img class="image block" src="https://i.pinimg.com/originals/d0/28/17/d02817e4f77f9d14a13937984d7adffc.gif">
    </div>
    <h1 class="bday">Animo Princesa no estes triste UwU</h1>
    <section>
</section>

<div class="pop">
  <span>✖</span>
  <img border="0" style=" width: 100%; " src="https://s5.postimg.org/imdjvuv1z/Feliz_cumplea_os_para_Mary_H.jpg">
 </div>
  </div>
</div>
<style>
        
    .inline-blocks > .block{
    display: inline-block;
    vertical-align: middle;
    }
    .image{
        height: 200px;
        margin-top: 75px;
        margin-left: 80px;

    }

    .twenty-one{
    font-size: 240px;
    font-family: 'Josefin Sans';
    font-weight: 100;
    line-height: 180px;
    color: #fff;
    margin: 40px 0;
    }

    .bday{
    font-size: 24px;
    color: #fff;
    font-family: 'Josefin Sans';
    font-weight: 300;
    text-align: center;
    }

    .cover{
    background: rgba(0,0,0,0.82);
    position: absolute;
    width: 100%;
    height: 100%;
    top:0;
    left: 0;
    z-index: 1000;
    }

    #can{
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    }


    .super-centered-container{
    display:flex;
    align-items: center;
    justify-content: center;
    }

    html,body{
    width: 100%;
    height: 100%;
    margin: 0;
    background:#131313;
    overflow:hidden;
    }

    a{
    color: skyblue;
    text-decoration: none;
    }

    .overlay-static{
    position: relative;
    z-index: 1000;
    margin-bottom: 100px;
    }

    body{
    background: url('https://s5.postimg.org/fr0gozr1z/Mary_collage.jpg');
    background-position: center center;
    background-size: contain;
    }


    section {
    text-align: center;
    }
    section > button {
    background: #20b9a4;
    border: 1px solid #fff;
    display: block;
    margin: 0 auto;
    margin-bottom: 20px;
    width: 200px;
    font-size: 16.996px;
    line-height: 20px;
    padding: 12px 18px 13px;
    -webkit-border-radius: 6px;
    -moz-border-radius: 6px;
    -ms-border-radius: 6px;
    -o-border-radius: 6px;
    border-radius: 6px;
    -webkit-transition: all 0.3s ease-in-out;
    -moz-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out;
    color: #ffffff;
    cursor: pointer;
    }
    section > button:hover {
    opacity: 0.8;
    -webkit-transition: all 0.3s ease-in-out;
    -moz-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out;
    }
    .pop {
    display: none;
    position: fixed;
    top: 2%;
    left: 10.3%;
    width: 80%;
    height: 80%;
    background: #ffffff;
    -webkit-border-radius: 6px;
    -moz-border-radius: 6px;
    -ms-border-radius: 6px;
    -o-border-radius: 6px;
    border-radius: 6px;
    outline: 10px solid rgba(0, 0, 0, 0.1);
    }

    .pop > span {
    cursor: pointer;
    position: absolute;
    top: 4%;
    right: 4%;
    -webkit-border-radius: 100px;
    -moz-border-radius: 100px;
    border-radius: 100px;
    background: #cccccc;
    color: #ffffff;
    padding: 6px 0px 0px 9px;
    width: 30px;
    height: 30px;
    }
</style>
<script>
        
    const TwoPI = Math.PI * 2;
    var w = window.innerWidth;
    var h = window.innerHeight;
    var center_x = w / 2;
    var center_y = h / 2;

    var colors = ['#E71D36', '#FF9F1C', '#2EC4B6', '#FDFFFC']

    // I know the abs is not needed... but oh well
    var max_distance = Math.abs(Math.max(center_x, center_y));
    var min_distance = Math.abs(Math.min(center_x, center_y));
    function Firefly(){
    this.velocity = 0;
    var random_angle = Math.random() * TwoPI;
    this.x = center_x +  Math.sin(random_angle) * ((Math.random() * (max_distance - min_distance) + min_distance));
    this.y = center_y + Math.cos(random_angle) * ((Math.random() * (max_distance - min_distance) + min_distance));

    
    
    this.angle_of_attack = Math.atan2(  this.y - center_y ,  this.x - center_x);
    this.vel =  ( Math.random() * 5 ) + 5 ;
    
    this.color = colors[ ~~(colors.length * Math.random()) ]
    
    
    this.xvel = this.vel * Math.cos( this.angle_of_attack );
    this.yvel = this.vel * Math.sin( this.angle_of_attack );
    this.size = 2 + Math.random() * 2;
    
    this.phase_diff = Math.random() * TwoPI;
        
    }



    Firefly.prototype.move = function(dt){
    if( isOnHeart(this.x, this.y)){
        this.size -= 0.001;
        return;
    }
    this.x += this.xvel * dt;
    this.y += this.yvel * dt;
    }

    Firefly.prototype.render = function(ctx, now){
    if( this.size < 1) {
        return;
    }
    ctx.globalAlpha = Math.max(Math.abs(Math.sin( (now + this.phase_diff) / (~~(this.size * 100)) )), 0.4);
    ctx.fillStyle = this.color;
    ctx.shadowColor = this.color;
    ctx.shadowBlur = 20 / this.size; 
    ctx.beginPath();
    ctx.arc( this.x, this.y, this.size, 0, TwoPI, false);
    ctx.closePath();
    ctx.fill();
    }

    var max_fireflies = 500;
    var canvas = document.getElementById('can');
    var ctx = canvas.getContext('2d');
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;

    var fireflies = [];


    var last = Date.now();
    var dt = 0, now = 0;
    var alive_fireflies = 0;
    var last_emit = 0;

    function render(){
    now = Date.now();
    dt = (last - now) / 1000; 
    last = now;
    ctx.clearRect(0,0,w,h);
    fireflies.forEach(function(f){
        f.move(dt);
        f.render(ctx, now);    
    });
    
    fireflies = fireflies.filter(function(f){
        return (f.size > 1);
    });

    alive_fireflies = fireflies.length;  
    
    if( alive_fireflies < max_fireflies && last_emit - now < - 100){
        fireflies.push( new Firefly());
        last_emit = now;
    }
    
    requestAnimationFrame(render);
    }


    render();

    // 
    function isOnHeart(x,y){
        x = ((x - center_x) / (min_distance * 1.2)) * 1.8;
        y = ((y - center_y) / (min_distance)) * - 1.8;

        var x2 = x * x;
        var y2 = y * y;
        // Simplest Equation of lurve
        return (Math.pow((x2 + y2 - 1), 3) - (x2 * (y2 * y)) <= 0);
    }

    $(document).ready(function () {
        $("button").click(function () {
            $(".pop").fadeIn(300);
            positionPopup();
        });

        $(".pop > span, .pop").click(function () {
            $(".pop").fadeOut(300);
        });

        const music = new Audio('words.mp3');
        music.play();
        music.loop =true;
        music.playbackRate = 2;
        music.pause();qqazszdgfbgtyj
    });
</script>

