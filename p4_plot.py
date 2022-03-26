#!/localdisk/anaconda3/bin/python
import sys
# get sys package for file arguments etc
import pymysql
import numpy as np
import scipy.stats as sp
import matplotlib.pyplot as plt
import io
import seaborn as sns
import pandas as pd
from scipy.optimize import curve_fit

con = pymysql.connect(host='localhost', user='s2160628', passwd='123456', db='s2160628')
cur = con.cursor()

if(len(sys.argv) != 4) :
    print ("Usage: p4_plot.py col name where ; Nparams = ",sys.argv)
    sys.exit(-1)


col1 = sys.argv[1]
col2 = sys.argv[2]
sel  = sys.argv[3]
sql = "SELECT %s,%s FROM Compounds where %s" % (col1,col2,sel)
# SELECT nhacc,nrotb FROM Compounds
cur.execute(sql)
nrows = cur.rowcount
ds = cur.fetchall()
ads = np.array(ds)
# print(ads)
# print ("correlation is",sp.pearsonr(ads[:,0],ads[:,1])," over ",nrows,"data")


# sns.heatmap(ads)
# plt.matshow(pd.DataFrame(ads).corr())
# colors = np.random.rand(N)
# area = (30 * np.random.rand(N))**2  # 0 to 15 point radii
# plt.scatter(ads[:,0], ads[:,1], alpha=0.5)
sns.set()
# Plot the density for the two cols
df = pd.DataFrame(ads, columns=[col1, col2])
df.plot.kde()

image = io.BytesIO()
plt.savefig(image,format='png')
sys.stdout.buffer.write(image.getvalue())
con.close()
