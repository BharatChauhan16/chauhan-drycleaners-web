<template>
  <div class="pg">

    <div class="page-hero">
      <div class="ph-bg"><div class="ph-orb"></div><div class="ph-grid"></div></div>
      <div class="container ph-body">
        <div class="breadcrumb" v-obs>
          <router-link to="/">Home</router-link>
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg>
          <span>Services</span>
        </div>
        <h1 v-obs>Our <em class="accent">Services</em></h1>
        <p v-obs>Comprehensive garment care with transparent pricing — no hidden charges.</p>
      </div>
    </div>

    <section class="section">
      <div class="container">

        <div
          v-for="(cat, ci) in cats"
          :key="cat.title"
          class="cat-block"
          v-obs
          :style="{ '--d': ci * 0.05 + 's' }"
        >
          <div class="cat-head">
            <div class="cat-ico"><span>{{ cat.icon }}</span></div>
            <div class="cat-meta">
              <h2>{{ cat.title }}</h2>
              <p>{{ cat.desc }}</p>
            </div>
            <span class="cat-pill" v-if="cat.badge">{{ cat.badge }}</span>
          </div>
          <div class="item-grid">
            <div class="item-card" v-for="item in cat.items" :key="item.name">
              <div class="item-name">{{ item.name }}</div>
              <div class="item-sub" v-if="item.desc">{{ item.desc }}</div>
              <div class="item-price">₹{{ item.price }}</div>
            </div>
          </div>
        </div>

        <!-- Add-ons -->
        <div class="addons" v-obs>
          <h3>Add-On Services</h3>
          <div class="addons-grid">
            <div class="addon" v-for="a in addons" :key="a.name">
              <span class="addon-ico">{{ a.icon }}</span>
              <div class="addon-info">
                <strong>{{ a.name }}</strong>
                <p>{{ a.desc }}</p>
              </div>
              <span class="addon-price">₹{{ a.price }}</span>
            </div>
          </div>
        </div>

        <!-- Note -->
        <div class="note" v-obs>
          <div class="note-icon">💡</div>
          <div>
            <h4>Pricing Note</h4>
            <p>Prices listed are base rates and may vary based on fabric type, garment size, stain severity, and embellishment level. All pricing is confirmed before we begin. <router-link to="/contact">Contact us</router-link> for custom quotes on bulk or bridal orders.</p>
          </div>
        </div>
      </div>
    </section>

    <div class="bot-cta" v-obs>
      <div class="container bot-cta-row">
        <div>
          <h3>Ready to get started?</h3>
          <p>Book your free pickup today and experience the Chauhan difference.</p>
        </div>
        <router-link to="/booking" class="btn-gold">
          Schedule Free Pickup
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </router-link>
      </div>
    </div>
  </div>
</template>

<script setup>
const vObs = {
  mounted(el) {
    const d = el.style.getPropertyValue('--d') || '0s'
    el.style.cssText += `opacity:0;transform:translateY(26px);transition:opacity .65s ease ${d},transform .65s ease ${d};`
    const io = new IntersectionObserver(([e]) => {
      if (e.isIntersecting) { el.style.opacity='1';el.style.transform='translateY(0)';io.disconnect() }
    }, { threshold: 0.07 })
    io.observe(el)
  }
}

const cats = [
  {
    icon:'👕', title:'Clothes Washing', badge:null,
    desc:'Machine and hand wash for all types of everyday clothing using eco-friendly detergents.',
    items:[
      {name:'T-Shirt / Half Sleeve Shirt',price:'30'},
      {name:'Full Sleeve Shirt',price:'35'},
      {name:'Jeans / Denim Trousers',price:'50'},
      {name:'Cotton Trousers',price:'45'},
      {name:'Kurta (Cotton)',price:'40'},
      {name:'Salwar Kameez Set',price:'60'},
      {name:'Kurti (Simple)',price:'35'},
      {name:'Sweater / Sweatshirt',price:'70'},
      {name:'Track Suit (Set)',price:'80'},
    ]
  },
  {
    icon:'🥼', title:'Dry Cleaning', badge:'Most Popular',
    desc:'Professional dry cleaning for delicate, formal, and luxury garments requiring specialized solvents.',
    items:[
      {name:'Suit (2-Piece)',desc:'Jacket + Trouser',price:'200'},
      {name:'Suit (3-Piece)',desc:'Jacket + Trouser + Waistcoat',price:'270'},
      {name:'Sherwani',price:'350'},
      {name:'Coat / Blazer',price:'180'},
      {name:'Formal Trouser',price:'80'},
      {name:'Saree (Plain Silk)',price:'200'},
      {name:'Salwar Kameez (Heavy Work)',price:'150'},
      {name:'Woolen Sweater',price:'100'},
      {name:'Woolen Jacket / Coat',price:'200'},
      {name:'Overcoat',price:'250'},
    ]
  },
  {
    icon:'🧺', title:'Ironing & Pressing', badge:null,
    desc:'Steam and press ironing for that crisp, wrinkle-free finish — every single time.',
    items:[
      {name:'Shirt / T-Shirt',price:'20'},
      {name:'Trousers',price:'25'},
      {name:'Saree',price:'30'},
      {name:'Kurta / Kurti',price:'20'},
      {name:'Salwar Kameez Set',price:'35'},
      {name:'Suit (Full)',price:'60'},
      {name:'Bundle of 10 pieces',price:'150'},
      {name:'Bundle of 20 pieces',price:'270'},
    ]
  },
  {
    icon:'🛏️', title:'Blankets, Quilts & Home Textiles', badge:null,
    desc:'Heavy-duty deep cleaning for all your home textiles regardless of size.',
    items:[
      {name:'Single Blanket (Cotton)',price:'150'},
      {name:'Double Blanket (Cotton)',price:'200'},
      {name:'Woolen Blanket (Single)',price:'200'},
      {name:'Woolen Blanket (Double)',price:'280'},
      {name:'Quilt / Duvet (Single)',price:'250'},
      {name:'Quilt / Duvet (Double)',price:'350'},
      {name:'Comforter',price:'300'},
      {name:'Pillow',price:'80'},
      {name:'Bed Sheet (Single)',price:'80'},
      {name:'Bed Sheet (Double)',price:'120'},
      {name:'Curtains (Per Panel)',price:'100'},
    ]
  },
  {
    icon:'👰', title:'Bridal & Wedding Outfit Care', badge:'Premium',
    desc:'Specialized care for your precious wedding garments — handled with extraordinary attention.',
    items:[
      {name:'Lehenga (Full Set)',desc:'Choli + Skirt + Dupatta',price:'800'},
      {name:'Heavy Bridal Lehenga',desc:'Zari/Zardozi work',price:'1200'},
      {name:'Silk Saree (Heavy Work)',price:'500'},
      {name:'Banarasi Saree',price:'600'},
      {name:'Sherwani (Bridal)',price:'600'},
      {name:'Achkan',price:'450'},
      {name:'Anarkali Suit (Heavy)',price:'400'},
      {name:'Dupatta (Heavy Embroidery)',price:'200'},
    ]
  },
]

const addons = [
  {icon:'🎯',name:'Stain Treatment',desc:'Specialized treatment for tough stains.',price:'50+'},
  {icon:'🌸',name:'Fabric Softening',desc:'Premium softener for extra softness.',price:'30'},
  {icon:'🧴',name:'Fabric Conditioner',desc:'Long-lasting freshness treatment.',price:'25'},
  {icon:'⚡',name:'Express Service (24hr)',desc:'50% surcharge on base price.',price:'+50%'},
  {icon:'📦',name:'Gift Packaging',desc:'Special fold & box packaging.',price:'50'},
  {icon:'🛡️',name:'Anti-Static Treatment',desc:'Reduce static on synthetic fabrics.',price:'40'},
]
</script>

<style scoped>
:root{--void:#060911;--abyss:#0B1018;--slate:#111827;--panel:#1A2333;--rim:rgba(255,255,255,0.07);--rim2:rgba(232,160,32,0.18);--gold:#E8A020;--gold-lt:#F5C842;--gold-dim:#7A4A00;--gold-glow:rgba(232,160,32,0.14);--teal:#0EA5A0;--cream:#F2EDE4;--fog:rgba(242,237,228,0.50);--mist:rgba(242,237,228,0.28);}
*{box-sizing:border-box;margin:0;padding:0;}
.pg{background:var(--void);color:var(--cream);font-family:'DM Sans',system-ui,sans-serif;}
.container{max-width:1240px;margin:0 auto;padding:0 28px;}
.section{padding:80px 0;}
.accent{color:var(--gold);font-style:normal;}

/* PAGE HERO */
.page-hero{background:var(--abyss);position:relative;overflow:hidden;padding:80px 0 56px;border-bottom:1px solid var(--rim);}
.ph-bg{position:absolute;inset:0;}
.ph-orb{position:absolute;width:360px;height:360px;border-radius:50%;background:radial-gradient(circle,rgba(232,160,32,.1) 0%,transparent 65%);top:-90px;right:-90px;}
.ph-grid{position:absolute;inset:0;background-image:linear-gradient(rgba(255,255,255,.016) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,.016) 1px,transparent 1px);background-size:60px 60px;}
.ph-body{position:relative;z-index:1;max-width:640px;}
.breadcrumb{display:flex;align-items:center;gap:6px;font-size:12.5px;color:var(--fog);margin-bottom:20px;}
.breadcrumb a{color:var(--gold);text-decoration:none;}
.breadcrumb svg{width:13px;height:13px;}
.ph-body h1{font-family:'Cormorant Garamond','Playfair Display',serif;font-size:clamp(2.4rem,5vw,3.8rem);font-weight:900;margin-bottom:13px;}
.ph-body p{color:var(--fog);font-size:16px;line-height:1.7;}

/* CAT BLOCK */
.cat-block{background:var(--slate);border:1px solid var(--rim);border-radius:22px;padding:34px;margin-bottom:20px;}
.cat-head{display:flex;align-items:flex-start;gap:18px;margin-bottom:26px;padding-bottom:22px;border-bottom:1px solid var(--rim);}
.cat-ico{width:56px;height:56px;border-radius:16px;flex-shrink:0;background:linear-gradient(135deg,rgba(232,160,32,.13),rgba(14,165,160,.06));border:1px solid rgba(232,160,32,.18);display:flex;align-items:center;justify-content:center;font-size:26px;}
.cat-meta{flex:1;}
.cat-meta h2{font-family:'Cormorant Garamond','Playfair Display',serif;font-size:1.55rem;font-weight:800;margin-bottom:5px;}
.cat-meta p{color:var(--fog);font-size:13.5px;line-height:1.6;}
.cat-pill{background:linear-gradient(135deg,var(--gold),var(--gold-dim));color:#fff;font-size:10.5px;font-weight:700;padding:5px 13px;border-radius:50px;letter-spacing:.07em;white-space:nowrap;height:fit-content;}
.item-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(210px,1fr));gap:9px;}
.item-card{background:var(--panel);border:1px solid var(--rim);border-radius:11px;padding:15px;display:flex;flex-direction:column;gap:4px;transition:all .2s;}
.item-card:hover{border-color:var(--rim2);background:rgba(232,160,32,.05);}
.item-name{font-size:13.5px;font-weight:500;}
.item-sub{font-size:11.5px;color:var(--fog);}
.item-price{font-size:16px;font-weight:700;color:var(--gold);margin-top:4px;}

/* ADDONS */
.addons{background:var(--slate);border:1px solid var(--rim);border-radius:22px;padding:34px;margin-bottom:20px;}
.addons h3{font-family:'Cormorant Garamond','Playfair Display',serif;font-size:1.45rem;font-weight:800;margin-bottom:22px;}
.addons-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(270px,1fr));gap:11px;}
.addon{display:flex;align-items:center;gap:13px;background:var(--panel);border:1px solid var(--rim);border-radius:13px;padding:15px 17px;transition:all .2s;}
.addon:hover{border-color:var(--rim2);}
.addon-ico{font-size:21px;flex-shrink:0;}
.addon-info{flex:1;}
.addon-info strong{display:block;font-size:13.5px;font-weight:600;margin-bottom:2px;}
.addon-info p{font-size:12px;color:var(--fog);}
.addon-price{font-size:15px;font-weight:700;color:var(--gold);white-space:nowrap;}

/* NOTE */
.note{display:flex;gap:16px;align-items:flex-start;background:rgba(232,160,32,.06);border:1px solid rgba(232,160,32,.16);border-radius:15px;padding:22px;margin-bottom:0;}
.note-icon{font-size:22px;flex-shrink:0;}
.note h4{font-weight:600;font-size:14.5px;margin-bottom:5px;}
.note p{color:var(--fog);font-size:13.5px;line-height:1.7;}
.note a{color:var(--gold);text-decoration:none;}
.note a:hover{text-decoration:underline;}

/* BOT CTA */
.bot-cta{background:var(--abyss);border-top:1px solid var(--rim);padding:48px 0;}
.bot-cta-row{display:flex;align-items:center;justify-content:space-between;gap:28px;flex-wrap:wrap;}
.bot-cta-row h3{font-family:'Cormorant Garamond','Playfair Display',serif;font-size:1.45rem;font-weight:800;margin-bottom:5px;}
.bot-cta-row p{color:var(--fog);font-size:13.5px;}

.btn-gold{display:inline-flex;align-items:center;gap:10px;background:linear-gradient(135deg,var(--gold),var(--gold-dim));color:#fff;font-weight:700;font-size:14px;padding:13px 26px;border-radius:50px;text-decoration:none;white-space:nowrap;box-shadow:0 5px 20px rgba(232,160,32,.38);transition:all .2s;}
.btn-gold:hover{transform:translateY(-2px);box-shadow:0 10px 28px rgba(232,160,32,.52);}
.btn-gold svg{width:15px;height:15px;}

@media(max-width:768px){
  .section{padding:52px 0;}
  .cat-head{flex-wrap:wrap;}
  .item-grid{grid-template-columns:1fr 1fr;}
  .bot-cta-row{flex-direction:column;text-align:center;}
}
@media(max-width:480px){.item-grid{grid-template-columns:1fr;}}
</style>
