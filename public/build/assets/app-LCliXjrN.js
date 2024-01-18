const h="modulepreload",m=function(l){return"/build/"+l},a={},v=function(u,i,d){let c=Promise.resolve();if(i&&i.length>0){const n=document.getElementsByTagName("link");c=Promise.all(i.map(e=>{if(e=m(e),e in a)return;a[e]=!0;const r=e.endsWith(".css"),f=r?'[rel="stylesheet"]':"";if(!!d)for(let s=n.length-1;s>=0;s--){const o=n[s];if(o.href===e&&(!r||o.rel==="stylesheet"))return}else if(document.querySelector(`link[href="${e}"]${f}`))return;const t=document.createElement("link");if(t.rel=r?"stylesheet":h,r||(t.as="script",t.crossOrigin=""),t.href=e,document.head.appendChild(t),r)return new Promise((s,o)=>{t.addEventListener("load",s),t.addEventListener("error",()=>o(new Error(`Unable to preload CSS for ${e}`)))})}))}return c.then(()=>u()).catch(n=>{const e=new Event("vite:preloadError",{cancelable:!0});if(e.payload=n,window.dispatchEvent(e),!e.defaultPrevented)throw n})};v(()=>import("./bootstrap-Ef_dYev6.js"),__vite__mapDeps([0,1]));
function __vite__mapDeps(indexes) {
  if (!__vite__mapDeps.viteFileDeps) {
    __vite__mapDeps.viteFileDeps = ["assets/bootstrap-Ef_dYev6.js","assets/bootstrap-xWbOpjjs.css"]
  }
  return indexes.map((i) => __vite__mapDeps.viteFileDeps[i])
}
