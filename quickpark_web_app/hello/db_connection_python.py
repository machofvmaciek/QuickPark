import serial
import mysql.connector
serialport = serial.Serial('COM10')
serialport.baudrate = 9600
serialport.bytesize = 8
serialport.parity = 'N'
serialport.stopbits = 1
print(serialport.name)

mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  password="",
  database = "quickpark"
)           

mycursor = mydb.cursor()
line = ["0", "0"]
while(1):
    sql = "UPDATE places SET status=%s WHERE idmiejsca = %s"
    '''
    #miejsce 0
    line[0] = serialport.readline()
    print(line[0])
    if(int(line[0])>50):
        val = (1,0)
    elif(int(line[0])<=50):
        val = (0,0)
    mycursor.execute(sql, val)
    mydb.commit()
    
    #miejsce 1
    line[1] = serialport.readline()
    print(line[1])
    if(int(line[1])>50):
        val = (1,1)
    elif(int(line[1])<=50):
        val = (0,1)
    mycursor.execute(sql, val)
    mydb.commit()
    

    print("-------")
    '''
    for i in range(2):
        line[i] = serialport.readline()
        print(line[i])
        if(int(line[i]) > 50):
            val = (1, i)
        elif(int(line[i]) <= 50):
            val = (0, i)
        mycursor.execute(sql, val)
        mydb.commit()

    print("--------")


serialport.close()


print(mydb)




print(mycursor.rowcount, "record inserted")