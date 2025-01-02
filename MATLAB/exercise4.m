% Read the data from the file

fid = fopen('gc-data-21.txt', 'r');
data = textscan(fid, '%f %s %f');
fclose(fid);

% 1.Identify the lines that contain data

ind = regexp(data{1}, 'Data');
ind = find(~cellfun(@isempty, ind));

% 2.Get the number of data points
npoints = length(ind);

% Read up to the data
x = data{1}(1:ind(1)-1);
y = data{2}(1:ind(1)-1);

% 3.    Initialize the data vectors
time = zeros(npoints, 1);
signal = zeros(npoints, 1);

% Read in the data
for i = 1:npoints
    time(i) = data{1}(ind(i));
    signal(i) = data{2}(ind(i));
end

% 4.Plot the data
figure
plot(time, signal)
xlabel('Time (s)')
ylabel('Signal')
title('data')

% Correct for non-zero baseline
signal = signal - mean(signal);

% 5.Implementing a fitting procedure using a decaying gaussian function
% Define the decaying gaussian function
gauss = @(p, x) p(1)*exp(-((x - p(2))./p(3)).^2) + p(4);

% Define the objective function
obj = @(p) sum((gauss(p, time) - signal).^2);

% Define the initial guess for the parameters
p0 = [1, mean(time), std(time), 0];

% Optimize the parameters
p = fminsearch(obj, p0);

% 6. implementing a fitting procedure with two peaks and plot the fitting function with an initial guess for each parameter
% Define the function that adds two decaying gaussian functions
gauss2 = @(p, x) p(1)*exp(-((x - p(2))./p(3)).^2) + p(4) + p(5)*exp(-((x - p(6))./p(7)).^2) + p(8);

% 7. Plot fitting function with an initial guess for each parameter
% First we define Define the initial guess for the parameters
p0 = [1, mean(time), std(time), 0, 1, mean(time), std(time), 0];

% Plot the fitting function with the initial guess for the parameters
figure
plot(time, gauss2(p0, time))
xlabel('Time (s)')
ylabel('Signal')
title('fitting function with initial guess')

% 8.using nonlinear fitting to get the parameters that best fit our data, and ploting the fit on the graph 
% Optimize the parameters
p2 = lsqnonlin(obj2, p0);

% Plot the fit on the graph
figure
plot(time, signal)
hold on
plot(time, gauss2(p2, time))
xlabel('Time (s)')
ylabel('Signal')

% 9.extracting out the two peaks and integrating the areas 
% Extract the two peaks
peak1 = gauss(p2(1:4), time);
peak2 = gauss(p2(5:8), time);
% Display the two peaks extracted
figure
plot(time, peak1)
hold on
plot(time, peak2)
xlabel('Time (s)')
ylabel('Signal')
legend('Peak 1', 'Peak 2')
title('the two extracted peaks')

% Integrate the areas
area1 = trapz(time, peak1);
area2 = trapz(time, peak2);
% Display the integrated areas
fprintf('Integrated area 1: %f\n', area1)
fprintf('Integrated area 2: %f\n', area2)

% 10.Compute the relative amounts
rel1 = area1/(area1 + area2);
rel2 = area2/(area1 + area2);
% Display the relative amounts
fprintf('Relative amount 1: %f\n', rel1)
fprintf('Relative amount 2: %f\n', rel2)




