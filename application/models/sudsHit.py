import requests
import suds.client
import suds_requests
import sys
# #La siguiente linea es para recibir desde php el valor de telefono:
telefono=sys.argv[2]
monto = sys.argv[1]
# telefono='552685748493'
# monto='20'
compania='Telcel'

session = requests.Session()
session.auth=('kirpal', '3D41BE')

#print(telefono + ' ;aqui ' + monto)

usuario = 'kirpal'
password = '3D41BE'
from suds.wsse import *
security = Security()
token = UsernameToken(usuario,password)
security.tokens.append(token)

c = suds.client.Client(
    'https://operaciones.hit.mx/Operaciones.svc?wsdl',
    transport=suds_requests.RequestsTransport(session)
)
c.set_options(wsse=security)
result = c.service.RecargarTiempoAire(compania,telefono,monto,"","123")
import unicodedata
def elimina_tildes(s):
   return ''.join((c for c in unicodedata.normalize('NFD', s) if unicodedata.category(c) != 'Mn'))
print elimina_tildes(result)
#print (result)

