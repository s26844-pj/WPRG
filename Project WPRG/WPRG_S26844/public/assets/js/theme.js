
(function(){
  const key='theme';
  const btn=document.getElementById('themeToggle');
  if(!btn) return;
  const set=(mode)=>{ document.documentElement.dataset.theme=mode; localStorage.setItem(key,mode); };
  btn.addEventListener('click',()=>{ const cur=localStorage.getItem(key)||'dark'; set(cur==='dark'?'light':'dark'); });
  set(localStorage.getItem(key)||'dark');
})();
