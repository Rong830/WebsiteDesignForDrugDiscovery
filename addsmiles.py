#!/usr/bin/python
import sys
# get sys package for file arguments etc
import MySQLdb
con = MySQLdb.connect(host='localhost', user='s2160628', passwd='123456', db='s2160628')
cur = con.cursor()
if(len(sys.argv) != 2) :
    print "Usage: addsmiles.py manufacture smi"
    sys.exit(-1)

manuname = sys.argv[1]
input_name = manuname+".smi"
sql = "SELECT id FROM Manufacturers WHERE name='%s'" % (manuname)
cur.execute(sql)
row = cur.fetchone()
supid = row[0]
with open(input_name,"r") as fi:
    for line in fi:
        elems = line.split()
        name = elems[0]
        sml = elems[1]
        sql = "Select id from Compounds where catn='%s' and ManuID='%s'" % (name,supid)
        cur.execute(sql)
        row = cur.fetchone()
        cid = row[0]
        sql = "insert into Smiles (cid,smiles) values (%s,'%s')" % (cid,sml)
        print sql,"\n";
        cur.execute(sql)
con.commit()
con.close()
