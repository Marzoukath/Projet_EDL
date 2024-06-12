$(document).ready(function(){
    var blackLine = $(".black-line"),
        ball = $(".main-container"),
        mainForm = $(".main-forms"),
        top = $(".pokemon-top-part"),
        bottom = $(".pokemon-bottom-part"),
        h = $(".sign-back h1"),
        row = $(".signup-row"),
        arrow= $(".signup-row a"),
        rem = $(".remember"),
        tl = new TimelineMax();
  
        // Start
        tl
        .to(blackLine,0.5,{className:'+=red-circle'})
        .to(blackLine,0.5,{className:'-=red-circle'})
        .to(blackLine,0.5,{className:'+=red-circle'})
        .to(blackLine,0.5,{className:'-=red-circle'})
        .to(blackLine,0.5,{className:'+=red-circle'})
        .to(blackLine,0.5,{className:'-=red-circle'})
        .to(blackLine,0.5,{className:'+=red-circle'})
        .to(blackLine,0.5,{className:'-=red-circle'})
        .to(ball,0.5,{y:"-70%",ease:Power4.easeOut})
        .to(ball,0.5,{y:"-50%",ease:Bounce.easeOut})
        .to(ball,0.5,{y:"-85%",ease:Power4.easeOut},"+=0.5")
        .to(ball,0.5,{y:"-50%",ease:Bounce.easeOut})
        .to(ball,0.5,{y:"-100%",ease:Power4.easeOut},"+=0.5")
        .to(ball,0.5,{y:"-50%",ease:Bounce.easeOut,onComplete:toggle})
        ;
        function toggle(o){
          $(".main-forms").slideDown(1500);
          tl
          .to(top,1,{autoAlpha:0})
          .to(bottom,1,{autoAlpha:0},"-=1")
          .fromTo(h,1,{autoAlpha:0,y:-20},{autoAlpha:1,y:0},"+=0.5")
          .staggerFrom(row,1,{left:"-100%",autoAlpha:0},0.2)
          .staggerFrom(rem,1,{cycle:{y:[20,-20]},autoAlpha:0},0.2)
  
  }
  
  })
  