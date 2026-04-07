<template>
  <div class="nf">
    <div class="nf-bg">
      <div class="nf-orb"></div>
      <div class="nf-grid"></div>
      <div class="nf-particles">
        <span v-for="(e, i) in icons" :key="i" class="nfp" :style="{ '--i': i + 1, top: (12 + i * 11) + '%', left: (i * 13) + '%' }">{{ e }}</span>
      </div>
    </div>

    <div class="nf-body">
      <div class="nf-404">
        <span class="n4 n4l">4</span>
        <div class="nz">
          <span class="nz-inner">0</span>
          <div class="nz-ring"></div>
        </div>
        <span class="n4 n4r">4</span>
      </div>

      <div class="hanger">
        <svg viewBox="0 0 200 120" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M100 22 Q100 2 120 2" stroke="rgba(232,160,32,0.5)" stroke-width="2.5" stroke-linecap="round" fill="none"/>
          <circle cx="120" cy="2" r="7" fill="none" stroke="rgba(232,160,32,0.5)" stroke-width="2"/>
          <path d="M100 22 Q70 52 20 90 Q10 100 20 105 Q30 110 40 105 L160 105 Q170 110 180 105 Q190 100 180 90 Q130 52 100 22" stroke="rgba(232,160,32,0.35)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
        </svg>
      </div>

      <h1>Page Not Found</h1>
      <p>Oops! This page went to the cleaners and never came back. Let's get you back to something fresh.</p>

      <div class="nf-actions">
        <router-link to="/" class="btn-gold">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
          Go Back Home
        </router-link>
        <router-link to="/services" class="btn-ghost">Browse Services</router-link>
        <router-link to="/booking" class="btn-ghost">Book Pickup</router-link>
      </div>

      <div class="nf-ql">
        <span>Or explore:</span>
        <router-link to="/about">About Us</router-link>
        <router-link to="/contact">Contact</router-link>
        <a href="tel:+918534837704">Call Us</a>
      </div>
    </div>
  </div>
</template>

<script setup>
const icons = ['👔','✨','🥼','🧺','👗','🛏️','👰','🌿']
</script>

<style scoped>
:root{--void:#060911;--abyss:#0B1018;--slate:#111827;--panel:#1A2333;--rim:rgba(255,255,255,0.07);--rim2:rgba(232,160,32,0.18);--gold:#E8A020;--gold-lt:#F5C842;--gold-dim:#7A4A00;--gold-glow:rgba(232,160,32,0.14);--teal:#0EA5A0;--cream:#F2EDE4;--fog:rgba(242,237,228,0.50);--mist:rgba(242,237,228,0.28);}
*{box-sizing:border-box;margin:0;padding:0;}
.nf{min-height:calc(100vh - 40px - 68px);background:var(--void);color:var(--cream);font-family:'DM Sans',system-ui,sans-serif;display:flex;align-items:center;justify-content:center;position:relative;overflow:hidden;text-align:center;padding:80px 28px;}

.nf-bg{position:absolute;inset:0;}
.nf-orb{position:absolute;width:580px;height:580px;border-radius:50%;background:radial-gradient(circle,rgba(232,160,32,.1) 0%,transparent 65%);top:50%;left:50%;transform:translate(-50%,-50%);}
.nf-grid{position:absolute;inset:0;background-image:linear-gradient(rgba(255,255,255,.015) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,.015) 1px,transparent 1px);background-size:64px 64px;}
.nf-particles{position:absolute;inset:0;pointer-events:none;}
.nfp{position:absolute;font-size:20px;opacity:0;animation:nfp 8s ease-in-out infinite;animation-delay:calc(var(--i) * 0.9s);}
@keyframes nfp{0%,100%{opacity:0;transform:translateY(0)}25%,75%{opacity:.1}50%{opacity:.14;transform:translateY(-18px) rotate(7deg)}}

.nf-body{position:relative;z-index:1;max-width:580px;}

/* 404 */
.nf-404{display:flex;align-items:center;justify-content:center;gap:8px;margin-bottom:4px;line-height:1;}
.n4{font-family:'Cormorant Garamond','Playfair Display',serif;font-weight:900;font-size:clamp(5.5rem,17vw,11rem);-webkit-text-stroke:2px rgba(232,160,32,.6);-webkit-text-fill-color:transparent;color:transparent;animation:n4in .8s ease both;}
.n4l{animation-delay:0s;}
.n4r{animation-delay:.28s;}
@keyframes n4in{from{opacity:0;transform:translateX(-26px)}to{opacity:1;transform:translateX(0)}}
.nz{position:relative;display:flex;align-items:center;justify-content:center;width:clamp(90px,15vw,150px);height:clamp(90px,15vw,150px);animation:nzin .8s ease .14s both;}
@keyframes nzin{from{opacity:0;transform:scale(.5) rotate(-160deg)}to{opacity:1;transform:scale(1) rotate(0)}}
.nz-inner{font-family:'Cormorant Garamond','Playfair Display',serif;font-weight:900;font-size:clamp(5rem,13vw,9.5rem);background:linear-gradient(135deg,var(--gold),var(--gold-lt));-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;position:relative;z-index:1;}
.nz-ring{position:absolute;inset:-8px;border-radius:50%;border:1.5px solid rgba(232,160,32,.18);animation:nzring 7s linear infinite;}
@keyframes nzring{to{transform:rotate(360deg)}}

/* HANGER */
.hanger{width:190px;margin:0 auto 30px;animation:hswing 4.5s ease-in-out infinite;}
@keyframes hswing{0%,100%{transform:rotate(-3deg)}50%{transform:rotate(3deg)}}
.hanger svg{width:100%;height:auto;}

.nf-body h1{font-family:'Cormorant Garamond','Playfair Display',serif;font-size:clamp(1.6rem,4vw,2.3rem);font-weight:800;margin-bottom:12px;}
.nf-body p{color:var(--fog);font-size:15.5px;line-height:1.75;margin-bottom:34px;max-width:460px;margin-left:auto;margin-right:auto;}

.nf-actions{display:flex;flex-wrap:wrap;gap:11px;justify-content:center;margin-bottom:28px;}
.btn-gold{display:inline-flex;align-items:center;gap:9px;background:linear-gradient(135deg,var(--gold),var(--gold-dim));color:#fff;font-weight:700;font-size:14.5px;padding:13px 24px;border-radius:50px;text-decoration:none;box-shadow:0 5px 20px rgba(232,160,32,.38);transition:all .2s;}
.btn-gold:hover{transform:translateY(-2px);box-shadow:0 10px 28px rgba(232,160,32,.52);}
.btn-gold svg{width:16px;height:16px;}
.btn-ghost{display:inline-flex;align-items:center;border:1px solid rgba(242,237,228,.12);color:var(--cream);font-weight:500;font-size:13.5px;padding:13px 20px;border-radius:50px;text-decoration:none;transition:all .2s;}
.btn-ghost:hover{border-color:var(--gold);color:var(--gold-lt);background:var(--gold-glow);}

.nf-ql{display:flex;gap:18px;justify-content:center;align-items:center;flex-wrap:wrap;}
.nf-ql span{color:var(--mist);font-size:12.5px;}
.nf-ql a{font-size:12.5px;color:var(--gold);text-decoration:none;font-weight:500;transition:opacity .2s;}
.nf-ql a:hover{opacity:.7;text-decoration:underline;}

@media(max-width:480px){
  .nf-actions{flex-direction:column;align-items:center;}
  .btn-gold,.btn-ghost{width:100%;justify-content:center;}
}
</style>
