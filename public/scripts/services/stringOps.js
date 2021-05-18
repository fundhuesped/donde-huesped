function removeAccents(value) {
  if ( typeof value === 'undefined' || value == null)
    return '';
  else
    return value
  .replace(/Á/g, 'A') 
  .replace(/á/g, 'a') 
  .replace(/â/g, 'a')
  .replace(/É/g, 'E')            
  .replace(/é/g, 'e')
  .replace(/è/g, 'e') 
  .replace(/ê/g, 'e')
  .replace(/Í/g, 'I')
  .replace(/í/g, 'i')
  .replace(/ï/g, 'i')
  .replace(/ì/g, 'i')
  .replace(/Ó/g, 'O')
  .replace(/ó/g, 'o')
  .replace(/ô/g, 'o')
  .replace(/Ú/g, 'U')
  .replace(/ú/g, 'u')
  .replace(/ü/g, 'u')
  .replace(/ç/g, 'c')
  .replace(/ß/g, 's');
}

function toTitleCase(str) {
  return str.replace(/\w\S*/g, function(txt) {
    return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
  });
}