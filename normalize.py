import os, time

current_time = 0

def process_change():
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
        file_target = "chatrooms/{0}.dat".format(category)
        print("Writing to {0}".format(file_target))
        print("Content: {0}".format(data))
        with open(file_target, "a") as target_file_stream:
            target_file_stream.write(data + "\n")

while True:
    current_stat = os.stat("input.txt")[8]
    if current_time == 0:
        current_time = current_stat
    if current_stat > current_time:
        current_time = current_stat
        print("Change Detected {0}".format(current_stat))
        process_change()