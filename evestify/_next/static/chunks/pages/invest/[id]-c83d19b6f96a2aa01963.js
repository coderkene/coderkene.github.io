_N_E=(window.webpackJsonp_N_E=window.webpackJsonp_N_E||[]).push([[19],{"//xy":function(e,t,c){"use strict";c.r(t),c.d(t,"__N_SSP",(function(){return m}));var s=c("nKUr"),i=c("q1tI"),n=c("YFqc"),a=c.n(n),r=c("5Yp1"),l=c("uNx/"),o=c("wIIz"),d=c("z/o8"),j=c("pc+1"),m=!0;t.default=function(e){var t=e.investment,c=e.layout,n=e.error,m=e.investmentListing;if(n)return null;if(!t)return Object(s.jsx)(l.default,{});var b=Object(i.useRef)(null);Object(i.useEffect)((function(){d.a.timeline().from(b,{delay:.5,duration:.5,y:50,autoAlpha:0,ease:j.b.out,stagger:1.5},0)}),[]);var h=m.filter((function(e){return e.title!==t.title})),u=t.profileimage,x=t.title,g=t.image,O=t.url,f=t.unitprice,p=t.investorcount,v=t.returnvalue,N=t.returnvaluecolor;return Object(i.useEffect)((function(){if(t){window.matchMedia("only screen and (max-width: 1024px)").matches&&window.location.assign("piggyvest://InvestPage?id=".concat(t.id,"&data=").concat(JSON.stringify({InvestID:t.id,Context:{Title:t.title,ProfileImage:t.profileimage,Image:t.image}})))}}),[t]),Object(s.jsxs)(r.a,{head:{title:"".concat(x," - PiggyVest"),logo:{url:"https://storage.googleapis.com/piggyvestwebsite/piggywebsite2020/investify_logo_8526104010/investify_logo_8526104010.svg"}},layoutProps:c,children:[Object(s.jsxs)("section",{className:"item-page",children:[Object(s.jsx)("hr",{}),Object(s.jsxs)("div",{className:"info",children:[Object(s.jsx)(a.a,{href:"/invest",children:Object(s.jsx)("a",{children:Object(s.jsxs)("h4",{className:"purple",children:[Object(s.jsx)("svg",{width:"27",height:"27",viewBox:"0 0 30 30",fill:"none",xmlns:"http://www.w3.org/2000/svg",children:Object(s.jsx)("path",{d:"M11.25 23.75L13.0125 21.9875L7.2875 16.25H27.5V13.75H7.2875L13.025 8.0125L11.25 6.25L2.5 15L11.25 23.75Z",fill:"#7913E5"})}),"Investify"]})})}),Object(s.jsxs)("div",{className:"pos-rel",children:[Object(s.jsx)("img",{className:"bg-image",ref:function(e){return b=e},src:g,alt:x,style:{height:"275px"}}),Object(s.jsx)("img",{className:"profile",src:u,alt:"display picture"})]}),Object(s.jsxs)("div",{className:"d-flex jc-fe verified",children:[Object(s.jsx)("p",{className:"purple",children:"Verified Opportunity"}),Object(s.jsx)("img",{className:"badge",src:"https://storage.googleapis.com/piggyvestwebsite/piggywebsite2020/verified_badge_c693fd84e8/verified_badge_c693fd84e8.svg",alt:"badge"})]}),Object(s.jsxs)("div",{className:"more-info",children:[Object(s.jsx)("h5",{className:"mb-5",children:x}),Object(s.jsx)("small",{children:"By an investment company"}),Object(s.jsxs)("div",{className:"row mb-3h",children:[Object(s.jsx)("div",{className:"col-md-4",children:Object(s.jsxs)("div",{className:"box",children:[Object(s.jsx)("h6",{children:f}),Object(s.jsx)("small",{children:"Per Unit"})]})}),Object(s.jsx)("div",{className:"col-md-4",children:Object(s.jsxs)("div",{className:"box",children:[Object(s.jsx)("h6",{children:p}),Object(s.jsx)("small",{children:"Investors"})]})}),Object(s.jsx)("div",{className:"col-md-4",children:Object(s.jsxs)("div",{className:"box",style:{backgroundColor:"".concat(N,"15")},children:[Object(s.jsx)("h6",{style:{color:N},children:v}),Object(s.jsx)("small",{style:{color:N},children:"Returns"})]})})]}),Object(s.jsx)(a.a,{href:O,children:Object(s.jsx)("a",{className:"btn text-center w-100 d-block mb-30 bg-purple-md",target:"_blank",children:"Invest"})}),Object(s.jsx)("p",{className:"text-center grey",children:"Invest now before it gets sold  out"})]})]})]}),Object(s.jsx)(o.a,{title:"Recent Opportunities on Investify",items:h,invest:!0,single:!0})]})}},nTj6:function(e,t,c){(window.__NEXT_P=window.__NEXT_P||[]).push(["/invest/[id]",function(){return c("//xy")}])},"uNx/":function(e,t,c){"use strict";c.r(t);var s=c("nKUr"),i=c("q1tI"),n=c("YFqc"),a=c.n(n);t.default=function(){var e=Object(i.useState)({image:{url:"https://storage.googleapis.com/piggyvestwebsite/piggywebsite2020/404_image_a6a5fea243/404_image_a6a5fea243.png",alternativeText:"An image describing a 404 not found error"},text:"Oops! We don't know where this is"}),t=e[0],c=e[1],n=t.image,r=t.text;return Object(i.useEffect)((function(){fetch("".concat("https://piggywebsite-cms-2021-dot-appconnectng.appspot.com","/not-found-page")).then((function(e){return e.json()})).then((function(e){c(e)}))}),[]),Object(s.jsx)("div",{className:"not-found d-flex al-i-c jc-c",children:Object(s.jsxs)("div",{className:"text-center",children:[Object(s.jsx)("img",{src:n.url,alt:n.alternativeText}),r&&Object(s.jsxs)("p",{children:[" ",r," "]}),Object(s.jsx)(a.a,{href:"/",children:Object(s.jsx)("a",{className:"btn btn-primary",children:"Go Back To Safety"})})]})})}},wIIz:function(e,t,c){"use strict";c.d(t,"b",(function(){return d})),c.d(t,"a",(function(){return j})),c.d(t,"c",(function(){return m}));var s=c("nKUr"),i=c("q1tI"),n=c("YFqc"),a=c.n(n),r=c("z/o8"),l=c("pc+1"),o=c("Sdyp");r.a.registerPlugin(o.ScrollTrigger);var d=function(e){var t=e.home,c=e.cards,n=Object(i.useRef)([]);n.current=[],Object(i.useEffect)((function(){r.a.timeline({scrollTrigger:{trigger:n.current,toggleActions:"play none none none"}}).fromTo(n.current,{autoAlpha:0,opacity:0},{duration:.75,autoAlpha:1,opacity:1,ease:l.b.out,stagger:{each:.75,amount:.5}},"+=0.5")}),[]);var o=function(e){e&&!n.current.includes(e)&&n.current.push(e)};return c.map((function(e){var c=Object(s.jsxs)(s.Fragment,{children:[Object(s.jsx)("img",{src:e.icon.url,alt:e.icon.alernateText,className:"icon",width:50,height:50}),Object(s.jsx)("h5",{className:"title",children:e.title}),Object(s.jsx)("p",{className:"text",children:e.description}),Object(s.jsxs)("div",{className:"sub-title",children:[Object(s.jsxs)("svg",{width:"33",height:"33",viewBox:"0 0 33 33",fill:"none",xmlns:"http://www.w3.org/2000/svg",children:[Object(s.jsx)("circle",{cx:"16.4438",cy:"16.7622",r:"16.0254",fill:e.bg}),Object(s.jsx)("path",{d:"M18.8477 11.1533L17.7179 12.2831L21.3877 15.9609L8.43118 15.9609L8.43118 17.5635L21.3877 17.5635L17.7099 21.2413L18.8477 22.3711L24.4565 16.7622L18.8477 11.1533Z",fill:e.linkColor})]}),e.tag]})]});return Object(s.jsx)("div",{ref:o,className:"col-md-4 box ".concat(t?"home hover ".concat("Dollar Savings"===e.title?"d-none":""):""),children:t?Object(s.jsx)(a.a,{href:e.link,children:Object(s.jsx)("a",{children:c})}):Object(s.jsxs)(s.Fragment,{children:[Object(s.jsx)("img",{src:e.icon.url,alt:e.icon.alernateText,className:"icon",width:50,height:50}),Object(s.jsx)("h5",{className:"title",children:e.title}),Object(s.jsx)("p",{className:"text",children:e.description})]})},e.title)}))},j=function(e){var t=e.invest,c=e.title,n=e.items,o=e.single,d=Object(i.useRef)([]);d.current=[],Object(i.useEffect)((function(){r.a.timeline({scrollTrigger:{trigger:d.current,toggleActions:"play none none none"}}).fromTo(d.current,{autoAlpha:0,opacity:0},{duration:.75,autoAlpha:1,opacity:1,ease:l.b.out,stagger:{each:.75,amount:.5}},"+=0.5")}),[]);var j=function(e){e&&!d.current.includes(e)&&d.current.push(e)},m={maxWidth:"300px",whiteSpace:"nowrap",overflow:"hidden",textOverflow:"ellipsis"};return Object(s.jsx)("section",{className:"alt-cards",style:o?{paddingBottom:"100px"}:{paddingBottom:0},children:Object(s.jsxs)("div",{className:"container",children:[Object(s.jsx)("h2",{className:"text-center mb-60",children:c}),Object(s.jsx)("div",{className:"row main-row",children:n.map((function(e){return Object(s.jsx)("div",{className:"col-md-4",ref:j,children:Object(s.jsx)(a.a,{href:t?"/invest/".concat(e.id):"/targets/".concat(e.id),children:Object(s.jsxs)("a",{children:[Object(s.jsx)("img",{src:"".concat(t?e.image:e.headerimage),alt:"card image",className:"image"}),Object(s.jsx)("div",{className:"content box",children:t?Object(s.jsxs)(s.Fragment,{children:[Object(s.jsx)("h5",{className:"mb-20 title",children:e.title}),Object(s.jsxs)("div",{className:"row mb-10",children:[Object(s.jsxs)("div",{className:"col-md-6 mb-20",children:[Object(s.jsx)("p",{className:"fw-bold",children:e.unitprice}),Object(s.jsx)("small",{children:"per unit"})]}),Object(s.jsxs)("div",{className:"col-md-6 mb-20",children:[Object(s.jsx)("p",{className:"fw-bold",children:e.investorcount}),Object(s.jsx)("small",{children:"Investors"})]})]}),Object(s.jsx)("p",{className:"tag",style:{color:e.actioncolor,backgroundColor:"".concat(e.actioncolor,"11")},children:e.actionname})]}):Object(s.jsxs)(s.Fragment,{children:[Object(s.jsx)("h5",{className:"mb-30 mt-10",style:m,children:e.title}),Object(s.jsxs)("div",{className:"row item-row mb-1h",children:[Object(s.jsxs)("div",{className:"col-auto mb-20",children:[Object(s.jsx)("p",{className:"fw-bold",children:e.membercount}),Object(s.jsx)("small",{children:"members"})]}),Object(s.jsxs)("div",{className:"col-auto mb-20",children:[Object(s.jsx)("p",{className:"fw-bold",children:e.target}),Object(s.jsx)("small",{children:"per member"})]}),Object(s.jsxs)("div",{className:"col-auto mb-20",children:[Object(s.jsx)("p",{className:"fw-bold",children:e.enddate}),Object(s.jsx)("small",{children:"days left"})]})]}),Object(s.jsxs)("div",{style:{width:"80%"},className:"mb-5 progress-container",children:[Object(s.jsxs)("p",{className:"fw-bold",children:[e.progress,"%"]}),Object(s.jsx)("div",{className:"progress",children:Object(s.jsx)("div",{className:"bar",style:{width:"".concat(e.progress,"%")}})})]})]})})]})})},e.id)}))})]})})},m=function(e){var t=e.stories,c=Object(i.useRef)([]);c.current=[],Object(i.useEffect)((function(){r.a.timeline({scrollTrigger:{trigger:c.current,toggleActions:"play none none none"}}).fromTo(c.current,{autoAlpha:0,opacity:0},{duration:.75,autoAlpha:1,opacity:1,ease:l.b.out,stagger:{each:.75,amount:.5}},"+=0.5")}),[]);var n=function(e){e&&!c.current.includes(e)&&c.current.push(e)};return Object(s.jsx)("div",{className:"container",children:Object(s.jsx)("div",{className:"row",children:t.map((function(e){var t=e.formattedTime.slice(10,e.formattedTime.length);return Object(s.jsx)("div",{className:"col-md-4 box",ref:n,children:Object(s.jsx)(a.a,{href:"/stories/".concat(e.id),children:Object(s.jsxs)("a",{children:[Object(s.jsx)("img",{src:e.avatar,alt:"profile-image",width:55,height:55}),Object(s.jsx)("h5",{className:"title mt-25 mb-20",children:e.name}),Object(s.jsx)("p",{className:"text",children:e.text}),Object(s.jsx)("small",{children:t})]})})},e.id)}))})})}}},[["nTj6",0,2,1,3]]]);