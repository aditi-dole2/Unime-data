

% Initialize data vectors
time = [];
signal = [];
% Open file
% Read in data lines
fid = fopen('gc-data-21.txt');

while ~feof(fid)
    % Read in line
    line = fgetl(fid);
    % Check if line contains 'Data'
    if regexp(line, 'Data')
        % Split line into cells
        cells = strsplit(line);
       
        % Convert cells to numbers and store in data vectors
       time = [time; str2double(cells{1})];
       signal = [signal; str2double(cells{2})];
    end
end
% Close file
fclose(fid);
%2:
% Correction non-zero baseline
signal_corrected = signal - mean(signal);
% Plot data
figure;
plot(time, signal_corrected,'y');
title('Corrected Data');
xlabel('Time (s)');
ylabel('Signal');
%3:
% Initialize data vectors
num_points=length(line);
time = [];
signal = [];
% Read in data
for i = 1:num_points
    % Read in time and signal values
    time_val = fscanf(fid, '%f', 1);
    signal_val = fscanf(fid, '%f', 1);
   
    % Store values in data vectors
    time = [time; time_val];
    signal = [signal; signal_val];
end
%4:
% Correct for non-zero baseline
signal_corrected = signal - mean(signal);
% Plot data
figure;
plot(time, signal_corrected,'y');
title('Corrected Data2');
xlabel('Time (s)');
ylabel('Signal');
% 5.fitting procedure using a decaying gaussian function
% Define the decaying gaussian function
gauss = @(p, x) p(1)*exp(-((x - p(2))./p(3)).^2) + p(4);
% objective function
obj = @(p) sum((gauss(p, time) - signal).^2);
%initial guess for parameters
p0 = [1, mean(time), std(time), 0];
% Optimizeparameters
p = fminsearch(obj, p0);
% fitting procedure with two peaks ,plot the fitting function with an initial guess for each parameter
%function of two decaying gaussian functions
gauss2 = @(p, x) p(1)*exp(-((x - p(2))./p(3)).^2) + p(4) + p(5)*exp(-((x - p(6))./p(7)).^2) + p(8);
% 7. Plot fitting function with an initial guess for each parameter
% Define the initial guess for the parameters
p0 = [1, mean(time), std(time), 0, 1, mean(time), std(time), 0];
% Ploting fitting function with the initial guess for the parameters
figure
plot(time, gauss2(p0, time))
xlabel('Time (s)')
ylabel('Signal')
title('fitting func. with initial guess')
%%8:
% Optimize the parameters
p2 = lsqnonlin(obj, p0);
% Plotting fit on graph
figure
plot(time, signal)
hold on
plot(time, gauss2(p2, time))
xlabel('Time (s)')
ylabel('Signal')
%9
% Extract two peaks
peak1 = gauss(p2(1:4), time);
peak2 = gauss(p2(5:8), time);
% plot the two peaks extracted
figure
plot(time, peak1)
hold on
plot(time, peak2)
xlabel('Time (s)')
ylabel('Signal')
legend('Peak 1', 'Peak 2')
title('the two extracted peaks')
%10:intrgrate area1 area2
area1 = trapz( peak1);
area2 = trapz(peak2);
disp( area1)
disp( area2)
%compute relative amounts
total_area = area1 + area2;
relative_amount1 = area1 / total_area;
relative_amount2 = area2 / total_area;
disp( relative_amount1)
disp( relative_amount2)