import os, time

current_time = 0

while True:
    current_stat = os.stat("input.txt")[8]
    if current_stat > current_time:
        current_time = current_stat
        print("Change Detect")
        with open("input.txt") as fp:
            line = fp.readline()
            category = "Unknown"
            data = ""
            cnt = 1
            while line:
                if  cnt == 1:
                    category = line.lower().replace('\n', '')
                else:
                    data += line + "\n" 
                line = fp.readline()
                cnt += 1
            data = repr(data)[:-3][1:]
            while "  " in data:
                data = data.replace("  ", " ")
            with open("chatrooms/{0}.dat".format(category), "a") as myfile:
                myfile.write(data + "\n")
